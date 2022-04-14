#!/bin/bash

echo "Set Sentry release..."
version=$(cat /tmp/workspace/release_number)
wp config set WP_SENTRY_VERSION "$version"
