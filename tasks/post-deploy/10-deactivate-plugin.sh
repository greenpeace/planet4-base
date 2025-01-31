#!/bin/bash

if [ "$APP_ENV" = "development" ]; then
  echo "Deactivate blocks plugin on dev sites..."
  wp plugin deactivate planet4-plugin-gutenberg-blocks
fi
