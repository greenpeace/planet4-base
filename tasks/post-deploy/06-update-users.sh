#!/bin/bash

echo "Sync default users..."
# wp user create <username> <email> --first_name="" --last_name=" - P4 team" --role=administrator --porcelain || true
# wp user delete <email> --reassign=1 --yes
wp user create crangulo crangulo@greenpeace.org --first_name="Carolina" --last_name="Romo Angulo - P4 team" --role=administrator --porcelain || true
wp user create tgarcia tgarcia@greenpeace.org --first_name="Toni" --last_name="Garcia - P4 team" --role=administrator --porcelain || true
