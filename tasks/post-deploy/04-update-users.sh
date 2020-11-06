#!/bin/bash

wp user create mfatome mfatome@greenpeace.org --first_name="Magali" --last_name="Fatome - P4 team" --role=administrator --porcelain || true
wp user delete wmorrisj --reassign=1 --yes
