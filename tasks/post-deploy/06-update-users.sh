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

wp user create gmintoco gmintoco@greenpeace.org --first_name="Gus" --last_name="Minto Cowcher - P4 team" --role=administrator --porcelain || true
wp user create tcavalca tcavalca@greenpeace.org --first_name="Tenorio" --last_name="Cavalcante - P4 team" --role=administrator --porcelain || true
