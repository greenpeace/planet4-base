#!/bin/bash

echo "Sync default users..."
# wp user create <username> <email> --first_name="" --last_name=" - P4 team" --role=administrator --porcelain || true
# wp user delete <email> --reassign=1 --yes
wp user create fpieters fpieters@greenpeace.org --first_name="Foppe" --last_name="Pieters - P4 team" --role=administrator --porcelain || true
