#!/bin/bash

# wp user create <username> <email> --first_name="" --last_name=" - P4 team" --role=administrator --porcelain || true
# wp user delete <email> --reassign=1 --yes

echo "Sync default users..."
wp user delete jmarubay@greenpeace.org --reassign=1 --yes
wp user delete pvincent@greenpeace.org --reassign=1 --yes
