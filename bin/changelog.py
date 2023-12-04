#!/usr/bin/env python3

import argparse
from base64 import b64decode
from datetime import date
from git import Repo, Actor
import requests
import os
from sendgrid import SendGridAPIClient
from sendgrid.helpers.mail import Mail
import sys

JIRA_API_QUERY = ('https://jira.greenpeace.org/rest/api/latest/search?'
                  'jql=project%20%3D%20PLANET%20AND%20fixVersion%20%3D%20')
JIRA_API_FIELDS = '&fields=summary,issuetype,customfield_12201,issuetype,assignee,labels'
GITHUB_API = 'https://api.github.com'
DOCS_REPO = 'greenpeace/planet4-docs'
DOCS_FOLDER = 'docs'
CHANGELOG_FILE = 'docs/platform/changelog/README.md'
OAUTH_KEY = os.getenv('GITHUB_OAUTH_TOKEN')
GITHUB_REPO_PREFIX = 'https://{0}@github.com/'.format(OAUTH_KEY)
AUTHOR_NAME = 'CircleCI Bot'
AUTHOR_EMAIL = os.getenv('GIT_USER_EMAIL')
HEADERS = {
    'Authorization': 'token {0}'.format(OAUTH_KEY),
    'Accept': 'application/vnd.github.v3+json'
}
SENDGRID_API_KEY = os.getenv('SENDGRID_API_KEY')
EMAIL_FROM = os.getenv('RELEASE_EMAIL_FROM')
EMAIL_TO = os.getenv('RELEASE_EMAIL_TO')
BASH_ENV = os.getenv('BASH_ENV')


def _is_contributor(flag):
    if flag:
        return ' <font size="1">⭐</font>'
    return ''


def _is_feature_flag(flag):
    if flag:
        return ' <font size="1">🔑</font>'
    return ''


def _is_feature_flag_md(flag):
    if flag:
        return ' 🔑'
    return ''


def _is_feature_flag_slack(flag):
    if flag:
        return '_[Feature Flag]_ '
    return ''


def _is_contributor_slack(flag):
    if flag:
        return '_[Community Contributed]_ '
    return ''


def get_release_tickets(version):
    api_endpoint = '{0}{1}{2}'.format(
        JIRA_API_QUERY,
        version,
        JIRA_API_FIELDS
    )
    response = requests.get(api_endpoint, verify=False)
    try:
        tickets = response.json()['issues']
    except KeyError:
        print('No issues. Wrong release number?')
        sys.exit(1)

    return tickets


def parse_tickets(jira_tickets):
    class Ticket(object):
        def __init__(self, number, issue_type, summary, contributor, feature_flag):
            self.number = number
            self.issue_type = issue_type
            self.summary = summary
            self.contributor = contributor
            self.feature_flag = feature_flag

        def __repr__(self):
            return '{0}, {1}, {2}, {3}, {4}'.format(
                self.number, self.issue_type, self.summary, self.contributor, self.feature_flag)

    features = []
    bugs = []
    infras = []

    had_contributions = False
    had_feature_flags = False

    for ticket in jira_tickets:
        number = ticket['key']
        fields = ticket['fields']
        issue_type = fields['issuetype']['name']
        summary = fields['summary']
        contributor = False
        try:
            if 'contributor' in fields['assignee']['name']:
                contributor = True
                had_contributions = True
        except TypeError:
            pass
        feature_flag = False
        if 'featureflag' in fields['labels']:
            feature_flag = True
            had_feature_flags = True

        if issue_type == 'Infra Task':
            infras.append(Ticket(number, issue_type, summary, contributor, feature_flag))
        elif issue_type == 'Bug':
            bugs.append(Ticket(number, issue_type, summary, contributor, feature_flag))
        else:
            features.append(Ticket(number, issue_type, summary, contributor, feature_flag))

    return infras, bugs, features, had_contributions, had_feature_flags


def ticket_template(mail, md, slack, ticket):
    mail = ('{0}<li><a href="https://jira.greenpeace.org/browse/{1}">{1}'
            '</a> - {2}{3}{4}</li>'.format(
                mail, ticket.number, ticket.summary,
                _is_contributor(ticket.contributor), _is_feature_flag(ticket.feature_flag)))

    md = '{0}- [{1}](https://jira.greenpeace.org/browse/{1}) - {2}{3}\n'.format(
        md, ticket.number, ticket.summary, _is_feature_flag_md(ticket.feature_flag))

    slack = '{0}- <https://jira.greenpeace.org/browse/{1}|{1}> - {3}{4}{2}\n'.format(
        slack, ticket.number, ticket.summary, _is_feature_flag_slack(ticket.feature_flag),
        _is_contributor_slack(ticket.contributor))

    return mail, md, slack


def generate_templates(version, infras, bugs, features):
    today = date.today()
    mail = ('Hi everyone,<br><br> A new Planet 4 release is being deployed today.'
            ' Below is the full list of changes.<br><h2>{0} - {1}</h2>'.format(version, today))
    md = '## {0} - {1}\n'.format(version, today)
    slack = ('A new release is currently being deployed: '
             '*<https://support.greenpeace.org/planet4/tech/changelog|{0}>*\n'.format(version))

    if len(features):
        mail = '{0}<h3>🔧 Features</h3><ul>'.format(mail)
        md = '{0}\n### Features\n\n'.format(md)
        slack = '{0}\n*:wrench: Features*\n\n'.format(slack)
        for ticket in features:
            mail, md, slack = ticket_template(mail, md, slack, ticket)
        mail = '{0}</ul>'.format(mail)

    if len(bugs):
        mail = '{0}<h3>🐞 Bug Fixes</h3><ul>'.format(mail)
        md = '{0}\n### Bug Fixes\n\n'.format(md)
        slack = '{0}\n*:ladybug: Bugs*\n\n'.format(slack)
        for ticket in bugs:
            mail, md, slack = ticket_template(mail, md, slack, ticket)
        mail = '{0}</ul>'.format(mail)

    if len(infras):
        mail = '{0}<h3>👷 Infrastructure</h3><ul>'.format(mail)
        md = '{0}\n### Infrastructure\n\n'.format(md)
        slack = '{0}\n*:construction_worker: Infrastructure*\n\n'.format(slack)

        for ticket in infras:
            mail, md, slack = ticket_template(mail, md, slack, ticket)
        mail = '{0}</ul>'.format(mail)

    return mail, md, slack


def commit_to_docs(version, md):
    print('Cloning docs repo...')
    docs_repo = Repo.clone_from('{0}{1}.git'.format(GITHUB_REPO_PREFIX, DOCS_REPO), DOCS_FOLDER)
    print('Docs repo cloned ✔')

    with open('{0}/{1}'.format(DOCS_FOLDER, CHANGELOG_FILE), 'r') as changelog:
        lines = changelog.readlines()

    with open('{0}/{1}'.format(DOCS_FOLDER, CHANGELOG_FILE), 'r+') as changelog:
        for line in lines:
            if line.startswith('{% endhint %}'):
                line = '{0}\n{1}'.format(line, md)
            changelog.write(line)

    # Prepare git
    author = Actor(AUTHOR_NAME, AUTHOR_EMAIL)

    # Stage, commit, push and pull
    print('Updating docs repo...')
    docs_repo.index.add(DOCS_FOLDER)
    commit = docs_repo.index.commit(':robot: Changelog {0}'.format(version),
                                    author=author, committer=author)
    print('Changes commited: {0}'.format(commit.message))
    origin = docs_repo.remotes['origin']
    ref = origin.push()
    print('Changes pushed to {0}'.format(ref[0].remote_ref.name))
    print('Push flag: {0}\n'.format(ref[0].flags))

    return


def send_mail(version, mail):
    token = b64decode(SENDGRID_API_KEY).decode('utf-8').replace('\n', '')
    sg = SendGridAPIClient(token)

    print('Sending email...')
    message = Mail(
        from_email=EMAIL_FROM,
        to_emails=EMAIL_TO,
        subject='[Release] v{0} 🤖'.format(version),
        html_content=mail)

    try:
        sg.send(message)
        print('Email sent ✔')
    except Exception as e:
        print(e)

    return


if __name__ == '__main__':
    # Options
    parser = argparse.ArgumentParser()
    parser.add_argument('--version', help='version number', required=True)
    args = parser.parse_args()

    # Parsed options
    version = args.version.split('v')[1]

    # Fetch and templetize
    print('Get Jira release tickets for {0}...'.format(version))
    jira_tickets = get_release_tickets(version)
    print('Parse {0} tickets'.format(len(jira_tickets)))
    infras, bugs, features, had_contributions, had_feature_flags = parse_tickets(jira_tickets)
    print('Generate templates...')
    mail, md, slack = generate_templates(version, infras, bugs, features)

    # Add template footnotes
    if had_contributions:
        mail = '{0}<br><font size="1">⭐ Community contributed</font>'.format(mail)
    if had_feature_flags:
        mail = '{0}<br><font size="1">🔑 [Feature Flag] Not enabled by default</font>'.format(mail)

    # Add template footer
    mail = ('{0}<br><br><a href="https://support.greenpeace.org/planet4/tech/changelog">'
            '<font size="1">Release History</font></a><br><br>The P4 Bot 🤖'.format(mail))

    output = 'export CHANGELOG="{0}"'.format(slack)

    with open('{0}'.format(BASH_ENV), 'a+') as bash_env:
        bash_env.write(output)

    # Commit to docs repo
    commit_to_docs(version, md)

    # Send mail notification
    send_mail(version, mail)
