#!/usr/bin/env python3
import sys


if __name__ == '__main__':
    if len(sys.argv) < 2:
        print('Verson argument is missing.\n Syntax: {0} <version>'.format(sys.argv[0]))
        exit(1)

    version = sys.argv[1]
    print(version)
