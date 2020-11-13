#!/bin/bash

# Make sure we exclude NROs on other TLDs
if [[ "$APP_HOSTNAME" == *"greenpeace.org"* ]]; then
  # Set custom wp-stateless domain
  wp option update sm_custom_domain "https://${APP_HOSTNAME}/static/${WP_STATELESS_MEDIA_BUCKET}/"

  # Search and replace existing assets
  wp search-replace "https://storage.googleapis.com/${WP_STATELESS_MEDIA_BUCKET}/" "https://${APP_HOSTNAME}/static/${WP_STATELESS_MEDIA_BUCKET}/" --precise --skip-columns=guid

  # Disable CF Image Optimization
  wp option patch delete planet4_options cloudflare_img_opt || true

  # Flush cache
  wp cache flush
fi
