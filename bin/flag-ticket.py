#!/usr/bin/env python3
import os
import requests
import sys

JIRA_API_QUERY = 'https://jira.greenpeace.org/rest/api/latest/issue/'
JIRA_API_FIELDS = '?fields=summary,issuetype,status,issuetype,assignee,labels'
JIRA_BASE_URL = 'https://jira.greenpeace.org/browse/'

BASH_ENV = os.getenv('BASH_ENV')


def get_ticket_meta(ticket_key):
    api_endpoint = '{0}{1}{2}'.format(
        JIRA_API_QUERY,
        ticket_key,
        JIRA_API_FIELDS
    )
    response = requests.get(api_endpoint, verify=False)

    try:
        fields = response.json()['fields']
    except KeyError:
        print('Not a valid ticket. Wrong ticket key?')
        sys.exit(1)

    try:
        status = fields['status']['name']
    except (KeyError, TypeError):
        raise Exception('Not a valid ticket status')

    if status == 'CLOSED':
        labels = fields['labels']
        if 'FLAG' not in labels:
            print('Not a FLAG ticket')
            sys.exit(0)

    summary = fields['summary']

    print('We found a FLAG ticket: <{0}{1}|{2}>'.format(JIRA_BASE_URL, ticket_key, summary))

    return summary


def generate_slack_msg(ticket_key, summary):
    msg = ('An important ticket was just completed!'
           ' This will be released on all dev sites in a few hours.'
           ' Please report any bug you see there in this thread and <@p4devs> will have a look.\n'
           ':wrench: *<{0}{1}|{1}: {2}>*\n'.format(JIRA_BASE_URL, ticket_key, summary))

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
