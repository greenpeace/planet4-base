#!/bin/bash

wp user create dtovbein dtovbein@greenpeace.org --first_name="Dan" --last_name="Tovbein - P4 team" --role=editor --porcelain || true
wp user delete nhazim@greenpeace.org --reassign=1 --yes
