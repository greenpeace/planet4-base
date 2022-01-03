#!/bin/bash

echo "De-activating WPML Media plugin..."
wp plugin deactivate wpml-media-translation || true
