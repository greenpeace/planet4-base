#!/usr/bin/env python3
import json
import os
from pycircleci.api import Api

USERNAME = 'greenpeace'
PROJECT = 'planet4-base'
BRANCH = 'main'
CIRCLE_TOKEN = os.getenv('CIRCLE_TOKEN')


if __name__ == '__main__':

    circleci = Api(CIRCLE_TOKEN)

    parameters = {
        "is_prod": True
    }

    response = circleci.trigger_pipeline(username=USERNAME,
                                         project=PROJECT,
                                         branch=BRANCH,
                                         params=parameters)

    print(json.dumps(response))
