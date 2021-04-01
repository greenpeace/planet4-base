#!/bin/bash

wp user create nhazim nhazim@greenpeace.org --first_name="Nour" --last_name="Hazim - P4 team" --role=editor --porcelain || true
wp user create hsaleh hsaleh@greenpeace.org --first_name="Houssam" --last_name="Saleh - P4 team" --role=editor --porcelain || true
wp user delete dpivo@greenpeace.org --reassign=1 --yes
wp user delete pcuadrad@greenpeace.org --reassign=1 --yes
wp user delete rawalker@greenpeace.org --reassign=1 --yes
wp user delete lreyes@greenpeace.org --reassign=1 --yes
