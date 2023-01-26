#!/bin/bash

echo "Set GF settings..."
wp option update rg_gforms_key "${GF_LICENSE}"
wp option add rg_gforms_enable_akismet 1 || true
wp option add gform_enable_noconflict 1 || true
wp option add gform_enable_background_updates 0 || true
wp option add rg_gforms_enable_html5 1 || true
wp option patch insert stateless-modules gravity-form true || wp option add stateless-modules '{"gravity-form": "true"}' --format=json
wp plugin activate gravityforms

echo "Copy GF language translation files..."
mkdir -p public/wp-content/languages/gravityforms/
rsync -ar public/wp-content/themes/planet4-master-theme/languages/plugins/gravityforms/ public/wp-content/languages/gravityforms/
