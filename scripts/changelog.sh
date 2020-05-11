#!/usr/bin/env bash
set -euo pipefail

function receive() {
  type="$1"

  JIRA_API_QUERY="https://jira.greenpeace.org/rest/api/latest/search?jql=project%20%3D%20PLANET%20AND%20fixVersion%20%3D%20${VERSION}%20AND%20type=${type}&fields=summary,issuetype,customfield_13100"

  jira_json=$(curl -s "$JIRA_API_QUERY")
  retval=$?
  if [ "$retval" -ne 0 ]; then
    echo "Failed to query JIRA for issue"
    exit 1
  fi

  echo "$jira_json" | jq --raw-output '.issues []  | .key ' > /tmp/$$.keys
  echo "$jira_json" | jq --raw-output '.issues []  | .fields .summary ' > /tmp/$$.summaries

  keys=()
  i=0
  while read -r line
  do
    keys[i]=$line
    i=$((i + 1))
  done < /tmp/$$.keys

  summaries=()
  i=0
  while read -r line
  do
    summaries[i]=$line
    i=$((i + 1))
  done < /tmp/$$.summaries

  total=${#keys[*]}

  if [ "$total" -ne 0 ]; then
    case $type in
      "Task")
        echo "### Features"
        ;;
      "Bug")
        echo "### Bug Fixes"
        ;;
    esac

    echo

    for (( i=0; i<=$(( total -1 )); i++ ))
    do
      key=$(echo "${keys[$i]}" | xargs )
      summary="${summaries[$i]}"
      echo "- [${key}](https://jira.greenpeace.org/browse/${key}) - ${summary}"
    done

    echo
  fi
}

VERSION="${1:-}"

if [ -z "$VERSION" ]; then
  echo "Usage: ./changelog.sh <version>"
  exit 1
fi

now="$(date +'%Y-%m-%d')"

echo
echo "## ${VERSION} - ${now}"
echo

receive "Task"
receive "Bug"
