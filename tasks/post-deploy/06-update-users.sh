#!/bin/bash

wp user create dtovbein dtovbein@greenpeace.org --first_name="Dan" --last_name="Tovbein - P4 team" --role=administrator --porcelain || true
wp user set-role dtovbein administrator
wp user delete nhazim@greenpeace.org --reassign=1 --yes
