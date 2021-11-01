#!/usr/bin/env bash
set -e

USER="greenpeace"

if [ -n "$1" ]; then
  REPO="$1"
fi

if [ -n "$2" ]; then
  TOKEN="$2"
else
  TOKEN="$CIRCLE_TOKEN"
fi

if [ -z "$TOKEN" ] || [ -z "$REPO" ]; then
  echo "Usage: ./rollback.sh <planet4-nro> <CircleCI TOKEN> <v0.x.x>"
  exit 0
fi

if [ -n "$3" ]; then
  TAG="$3"
else
  TAG=$(curl -s "https://api.github.com/repos/greenpeace/${REPO}/tags" | jq -r .[1].name)
fi

json=$(jq -n \
  --arg VAL "$TAG" \
  --argjson ROLLBACK "true" \
  '{
  "tag": $VAL,
  "parameters": {
    "rollback": $ROLLBACK
  }
}')

echo "Triggering a rollback pipeline..."
echo "Build: ${USER}/${REPO}"
echo "$json"
echo

curl \
  --header "Content-Type: application/json" \
  -d "$json" \
  -u "${TOKEN}:" \
  -X POST \
  "https://circleci.com/api/v2/project/github/${USER}/${REPO}/pipeline"

echo
echo
echo "To approve:"
echo "https://app.circleci.com/pipelines/github/${USER}/${REPO}/"
echo
