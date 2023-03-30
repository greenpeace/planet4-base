#!/bin/bash

echo "Sync default users..."
# wp user create <username> <email> --first_name="" --last_name=" - P4 team" --role=administrator --porcelain || true
# wp user delete <email> --reassign=1 --yes
wp user delete sgrishpu@greenpeace.org --reassign=1 --yes
wp user delete apapamat@greenpeace.org --reassign=1 --yes
wp user delete mfatome@greenpeace.org --reassign=1 --yes
