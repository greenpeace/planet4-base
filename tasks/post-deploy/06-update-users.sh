#!/bin/bash

echo "Sync default users..."
# wp user create <username> <email> --first_name="" --last_name=" - P4 team" --role=administrator --porcelain || true
# wp user delete <email> --reassign=1 --yes
wp user create mmarcott mmarcott@greenpeace.org --first_name="Molly" --last_name="Marcott - P4 team" --role=administrator --porcelain || true
