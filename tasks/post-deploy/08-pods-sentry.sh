#!/bin/bash

echo "Set Sentry release..."
version=$(cat /app/source/public/release_number)
wp config set WP_SENTRY_VERSION "$version"
