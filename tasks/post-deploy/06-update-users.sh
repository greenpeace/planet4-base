#!/bin/bash

echo "Sync default users..."
# wp user create <username> <email> --first_name="" --last_name=" - P4 team" --role=administrator --porcelain || true
# wp user delete <email> --reassign=1 --yes
wp user delete fhernand@greenpeace.org --reassign=1 --yes
wp user delete dgracian@greenpeace.org --reassign=1 --yes
wp user delete eberger@greenpeace.org --reassign=1 --yes
wp user delete tcavalca@greenpeace.org --reassign=1 --yes
wp user delete amelekou@greenpeace.org --reassign=1 --yes
