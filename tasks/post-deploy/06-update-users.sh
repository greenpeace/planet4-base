#!/bin/bash

wp user create nhazim nhazim@greenpeace.org --first_name="Nour" --last_name="Hazim - P4 team" --role=editor --porcelain || true
wp user create hsaleh hsaleh@greenpeace.org --first_name="Houssam" --last_name="Saleh - P4 team" --role=editor --porcelain || true
wp user delete dpivo --reassign=1 --yes
