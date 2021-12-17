#!/bin/bash

echo "Get Cloudflare key..."
wp p4-cf-key-in-db "${APP_HOSTNAME}"
wp plugin activate cloudflare

echo "Trigger a cache purge, but only if this is enabled for the site..."
wp p4-cf-purge --all || echo "Command probably does not exist"

