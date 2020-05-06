#!/usr/bin/env python3
import json
import requests
import sys
from datetime import date
import urllib3


def receive(version):
    JIRA_API_QUERY='https://jira.greenpeace.org/rest/api/latest/search?jql=project%20%3D%20PLANET%20AND%20fixVersion%20%3D%20{0}+order+by+issuetype&fields=summary,issuetype,customfield_13100'.format(version)

    class Ticket(object):
        def __init__(self, number, summary, cat, flag):
            self.number = number
            self.summary = summary
            self.cat = cat
            self.flag = flag

        def __repr__(self):
            return "Test()"

    urllib3.disable_warnings()
    response = requests.get(JIRA_API_QUERY, verify=False)
    binary = response.content
    data = json.loads(binary)

    tickets = [ ]

    try:
        issues = data['issues']
    except KeyError:
        print('No issues. Wrong release number?')
        sys.exit(1)

    for ticket in data['issues']:
        number = ticket['key']
        fields = ticket['fields']

        summary = fields['summary']

        flag = fields['customfield_13100']

        cat = fields['issuetype']['name']

        tickets.append(Ticket(number, summary, cat, flag))
    return tickets


def display(tickets, cat):
    for ticket in tickets:
        if ticket.cat == cat:
            print('- [{0}](https://jira.greenpeace.org/browse/{0}) - {1}'.format(ticket.number, ticket.summary))
            if ticket.flag:
                print('  {0}'.format(ticket.flag))
    print('')


if __name__ == '__main__':
    if len(sys.argv) < 2:
        print('Usage: ./changelog.py <version>')
        sys.exit(1)

    version = sys.argv[1]

    tickets = receive(version)

    today = date.today().strftime('%Y-%m-%d')

    print('## {0} - {1}\n'.format(version, today))

    # Get Tasks
    print('### Features\n')
    display(tickets, 'Task')

    # Get Bugs
    print('### Bug Fixes\n')
    display(tickets, 'Bug')
