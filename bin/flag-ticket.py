#!/usr/bin/env python3
from base64 import b64decode
from jira import JIRA
import os
import sys

JIRA_SERVER = 'https://greenpeace-planet4.atlassian.net/'
JIRA_API_URL = 'rest/api/latest/issue/'
JIRA_TICKET_URL = 'browse/'
JIRA_USER = os.getenv('JIRA_USER')
JIRA_TOKEN = os.getenv('JIRA_TOKEN')
BASH_ENV = os.getenv('BASH_ENV')


def get_ticket_meta(ticket_key):
    token = b64decode(JIRA_TOKEN).decode('utf-8').replace('\n', '')
    jira = JIRA(server=JIRA_SERVER, basic_auth=(JIRA_USER, token))

    try:
        ticket = jira.issue(ticket_key)
    except:  # noqa: E722
        print('Not a valid ticket. Wrong ticket key?')
        sys.exit(1)

    status = ticket.fields.status.name

    if status != 'Closed':
        print('Not a closed ticket.')
        sys.exit(0)

    labels = ticket.fields.labels
    if 'FLAG' not in labels:
        print('Not a FLAG ticket')
        sys.exit(0)

    summary = ticket.fields.summary

    print('We found a FLAG ticket: <{0}{1}{2}|{3}>'.format(JIRA_SERVER, JIRA_TICKET_URL,
                                                           ticket_key, summary))

    return summary


def generate_slack_msg(ticket_key, summary):
    msg = (':planet4: An important ticket was just completed!'
           ' This will be released on all dev sites in a few hours.'
           ' Please report any bug you see there in this thread and P4 team will have a look.\n'
           ':gear: *<{0}{1}{2}|{2}: {3}>*\n'.format(JIRA_SERVER, JIRA_TICKET_URL,
                                                    ticket_key, summary))

    return msg


if __name__ == '__main__':
    if len(sys.argv) < 2:
        print('Ticket number is missing.\n Syntax: {0} <PLANET-XXXX>'.format(sys.argv[0]))
        exit(1)

    ticket_key = sys.argv[1]

    print('Getting ticket information...')
    summary = get_ticket_meta(ticket_key)

    msg = generate_slack_msg(ticket_key, summary)

    output = 'export SLACK_MSG="{0}"'.format(msg)
    with open('{0}'.format(BASH_ENV), 'a+') as bash_env:
        bash_env.write(output)
