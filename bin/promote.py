#!/usr/bin/env python3
import json
import os
import requests
from git import Repo, Actor
import semver
import sys
from time import sleep

GITHUB_API = 'https://api.github.com'
BASE_REPO = 'greenpeace/planet4-base'
BASE_FOLDER = 'base'
BASE_APPS = 'production.json'
THEME_REPO = 'greenpeace/planet4-master-theme'
MAIN_BRANCH = 'main'
RELEASE_BRANCH = 'release'
OAUTH_KEY = os.getenv('GITHUB_OAUTH_TOKEN')
GITHUB_REPO_PREFIX = 'https://{0}@github.com/'.format(OAUTH_KEY)
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
    print('New tag: {0}'.format(new_tag))

    data = {
        'tag_name': new_tag,
        'name': new_tag
    }
    repo_endpoint = '{0}/repos/{1}/releases'.format(
        GITHUB_API,
        repo
    )
    response = requests.post(repo_endpoint, headers=HEADERS, data=json.dumps(data))

    return latest_tag, new_tag


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
    if not (1000000 <= size <= 9000000):
        print('Assets size is invalid: {0}'.format(size))
        return False

    print('Assets are ready\n')
    return True


def create_pull_request(title, diffs):
    body = '**Changelog:**'
    for repo in diffs:
        body = '{0}<br>- https://github.com/{1}/compare/{2}'.format(body, repo, diffs[repo])

    repo_endpoint = '{0}/repos/{1}/pulls'.format(
        GITHUB_API,
        BASE_REPO
    )
    data = {
        'head': RELEASE_BRANCH,
        'base': MAIN_BRANCH,
        'title': title,
        'body': body
    }
    response = requests.post(repo_endpoint, headers=HEADERS, data=json.dumps(data))

    return response.json()['url']


if __name__ == '__main__':
    if len(sys.argv) < 2:
        print('Verson argument is missing.\n Syntax: {0} <version>'.format(sys.argv[0]))
        exit(1)

    version = sys.argv[1]

    print('Cloning base repo...')
    base_repo = Repo.clone_from('{0}{1}.git'.format(GITHUB_REPO_PREFIX, BASE_REPO), BASE_FOLDER)
    with open('{0}/{1}'.format(BASE_FOLDER, BASE_APPS), 'r') as prod_file:
        requirements = json.load(prod_file)
    print('Base repo cloned ✔')
    print('{0}\n'.format(requirements))

    # Bump theme repo
    diffs = {}
    print('Creating new tag on {0}'.format(THEME_REPO))
    latest_tag, new_tag = create_new_tag(THEME_REPO)
    diffs[THEME_REPO] = '{0}...{1}'.format(latest_tag, new_tag)
    requirements['require'][THEME_REPO] = new_tag
    assets = False
    while not assets:
        print('Checking for assets...')
        sleep(30)
        assets = check_assets(THEME_REPO, new_tag)

    with open('{0}/{1}'.format(BASE_FOLDER, BASE_APPS), 'w') as prod_file:
        json.dump(requirements, prod_file, indent=2)
        print('Bumping app repos to base\n {0}'.format(requirements))

    # Prepare git
    author = Actor(AUTHOR_NAME, AUTHOR_EMAIL)

    # Stage, commit, push and pull
    print('Switch to branch {0}...'.format(RELEASE_BRANCH))
    branch = base_repo.create_head(RELEASE_BRANCH)
    base_repo.head.reference = branch
    print('Updating base repo...')
    staged = base_repo.index.add(BASE_APPS)
    print('Changes staged: {0}'.format(staged))
    commit = base_repo.index.commit('[release] {0}'.format(version),
                                    author=author, committer=author)
    print('Changes commited: {0}'.format(commit.message))
    origin = base_repo.remotes['origin']
    ref = origin.push(RELEASE_BRANCH)
    print('Changes pushed to {0}'.format(ref[0].remote_ref.name))
    print('Push flag: {0}\n'.format(ref[0].flags))
    pull = create_pull_request('[release] {0}'.format(version), diffs)
    print('Pull Request created at {0}'.format(pull))

    print('Promotion complete')
