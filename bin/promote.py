#!/usr/bin/env python3
import json
import os
import requests
from git import Repo, Actor
import semver
import sys
from time import sleep

GITHUB_API = 'https://api.github.com'
GITHUB_REPO_PREFIX = 'git@github.com:'
BASE_REPO = 'greenpeace/planet4-base'
BASE_FOLDER = 'base'
BASE_APPS = 'production.json'
APP_REPOS = {
    'greenpeace/planet4-master-theme',
    'greenpeace/planet4-plugin-gutenberg-blocks'
}
OAUTH_KEY = os.getenv('GITHUB_OAUTH_TOKEN')
AUTHOR_NAME = 'CircleCI Bot'
AUTHOR_EMAIL = os.getenv('GIT_USER_EMAIL')
HEADERS = {
    'Authorization': 'token {0}'.format(OAUTH_KEY),
    'Accept': 'application/vnd.github.v3+json'
}


def bump_version(text, prefix='v'):
    """
    Takes a tag number as an argument and increments the minor version.
    """

    # Remove version prefix
    if text.startswith(prefix):
        text = text[len(prefix):]

    # Convert to semver
    if len(text.split('.')) < 3:
        text = '{0}.0'.format(text)

    # Bump minor
    ver = semver.VersionInfo.parse(text)
    next_ver = 'v{0}'.format(str(ver.bump_minor()))

    return next_ver


def create_new_tag(repo):
    repo_endpoint = '{0}/repos/{1}/releases/latest'.format(
        GITHUB_API,
        repo
    )
    response = requests.get(repo_endpoint, headers=HEADERS)
    latest_tag = response.json()['tag_name']
    print('Latest tag: {0}'.format(latest_tag))

    new_tag = bump_version(latest_tag)
    print('New tag: {0}\n'.format(new_tag))

    data = {
        'tag_name': new_tag,
        'name': new_tag
    }
    repo_endpoint = '{0}/repos/{1}/releases'.format(
        GITHUB_API,
        repo
    )
    response = requests.post(repo_endpoint, headers=HEADERS, data=json.dumps(data))

    return new_tag


def check_assets(repo, tag):
    repo_endpoint = '{0}/repos/{1}/releases/tags/{2}'.format(
        GITHUB_API,
        repo,
        tag
    )
    response = requests.get(repo_endpoint, headers=HEADERS)
    assets = response.json()['assets']

    if not len(assets):
        print('Assets not uploaded yet')
        return False

    size = assets[0]['size']
    if not (1000000 <= size <= 5000000):
        print('Assets size is invalid: {0}'.format(size))
        return False

    print('Assets are ready')
    return True


if __name__ == '__main__':
    if len(sys.argv) < 2:
        print('Verson argument is missing.\n Syntax: {0} <version>'.format(sys.argv[0]))
        exit(1)

    version = sys.argv[1]

    print('Cloning base repo...')
    base_repo = Repo.clone_from('{0}{1}.git'.format(GITHUB_REPO_PREFIX, BASE_REPO), BASE_FOLDER)
    with open('{0}/{1}'.format(BASE_FOLDER, BASE_APPS), 'r') as prod_file:
        requirements = json.load(prod_file)
    print('Base repo cloned\n')

    # Bump app repos
    for repo in APP_REPOS:
        print('Creating new tag on {0}'.format(repo))
        new_tag = create_new_tag(repo)
        requirements['require'][repo] = new_tag
        assets = False
        while not assets:
            print('Checking for assets...')
            sleep(30)
            assets = check_assets(repo, new_tag)

    with open('{0}/{1}'.format(BASE_FOLDER, BASE_APPS), 'w') as prod_file:
        json.dump(requirements, prod_file, indent=2)
        print('Bumping app repos to base\n {0}'.format(requirements))

    # Prepare git
    author = Actor(AUTHOR_NAME, AUTHOR_EMAIL)

    # Stage, commit, push
    print('Commiting to base repo...\n')
    base_repo.index.add(BASE_APPS)
    base_repo.index.commit('[release] {0}'.format(version), author=author, committer=author)
    origin = base_repo.remotes['origin']
    origin.push()

    print('Promotion complete')
