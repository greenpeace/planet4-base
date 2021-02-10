#!/bin/sh

# Trigger a purge, but only if this is enabled for the site if the "cloudflare_deploy_purge" feature is on.
wp p4-cf-purge --all || echo "Command probably does not exist"
