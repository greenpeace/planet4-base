#!/bin/bash

echo "De-activating WPML Media plugin..."
wp plugin is-installed wpml-media-translation && wp plugin deactivate wpml-media-translation
