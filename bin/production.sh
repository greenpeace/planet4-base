#!/usr/bin/env bash
# shellcheck disable=SC2016
set -eu

json=$(jq -n \
  --arg branch "planet-6384" \
  --argjson is_prod "true" \
  '{
	"branch": $branch,
  "parameters": {
    "is_prod": $is_prod
  }
}')

echo "$json"

curl \
  --header "Content-Type: application/json" \
  -d "$json" \
  -u "${CIRCLE_TOKEN}:" \
  -X POST \
  "https://circleci.com/api/v2/project/gh/greenpeace/planet4-base/pipeline"
