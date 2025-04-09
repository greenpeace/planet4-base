#!/bin/bash

echo "Perform WP-Stateless data optimization..."
wp stateless migrate auto --email=nroussos@greenpeace.org --yes
