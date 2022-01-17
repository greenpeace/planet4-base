#!/usr/bin/env python3
import json
import os
import requests
import sys

GITHUB_API = 'https://api.github.com'
BASE_REPO = 'greenpeace/planet4-base'
OAUTH_KEY = os.getenv('GITHUB_OAUTH_TOKEN')
HEADERS = {
    'Authorization': 'token {0}'.format(OAUTH_KEY),
    'Accept': 'application/vnd.github.v3+json'
}

if __name__ == '__main__':
    if len(sys.argv) < 2:
        print('Commit message is missing.\n Syntax: {0} <commit_msg>'.format(sys.argv[0]))
        exit(1)

    commit_msg = sys.argv[1]
    try:
        version = commit_msg.split('] ')[1].split(' ')[0]
    except IndexError:
        print('No version detected in commit message: {0}'.format(commit_msg))
        exit(1)

    print('Creating new tag on {0}'.format(BASE_REPO))
    print('New tag: {0}\n'.format(version))

    data = {
        'tag_name': version,
        'name': version
    }
    repo_endpoint = '{0}/repos/{1}/releases'.format(
        GITHUB_API,
        BASE_REPO
    )
    response = requests.post(repo_endpoint, headers=HEADERS, data=json.dumps(data))
