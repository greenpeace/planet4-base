#!/bin/bash

# wp user create <username> <email> --first_name="" --last_name=" - P4 team" --role=administrator --porcelain || true
# wp user delete <email> --reassign=1 --yes

echo "Sync default users..."
if [ "$APP_ENV" = "development" ]; then
  wp user delete jhasenau@greenpeace.org --reassign=1 --yes
  wp user delete aradu@greenpeace.org --reassign=1 --yes
  wp user delete tdhooper@greenpeace.org --reassign=1 --yes
  wp user delete lhillige@greenpeace.org --reassign=1 --yes
  wp user delete ltitus@greenpeace.org --reassign=1 --yes
  wp user delete tzetterl@greenpeace.org --reassign=1 --yes
fi
