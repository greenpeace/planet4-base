#!/bin/bash

echo "Sync default users..."
# wp user create <username> <email> --first_name="" --last_name=" - P4 team" --role=administrator --porcelain || true
# wp user delete <email> --reassign=1 --yes
wp user create tkaus tkaus@greenpeace.org --first_name="Taylor" --last_name="Kaus - P4 team" --role=editor --porcelain || true
wp user create qdebode qdebode@greenpeace.org --first_name="Quentin" --last_name="Debode - P4 team" --role=administrator --porcelain || true
wp user create oagbernd oagbernd@greenpeace.org --first_name="Osong" --last_name="Agberndifor - P4 team" --role=administrator --porcelain || true
