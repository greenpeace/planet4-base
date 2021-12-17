#!/bin/bash

echo "Get GP packages..."
master_json=$(jq '[.packages | .[] | select(.name | startswith( "greenpeace")) | [.name , .version , .source]]' composer.lock)
echo "$master_json"

wp option update greenpeace_packages --format=json "$master_json"
