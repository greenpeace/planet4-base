#!/bin/bash

echo "Configure Gravity Forms plugin..."
wp option update rg_gforms_key "${GF_LICENSE%$'\n'}"
wp option update rg_gforms_enable_akismet 1 || true
wp option update gform_enable_noconflict 0 || true
wp option update gform_enable_background_updates 0 || true
wp option update rg_gforms_enable_html5 1 || true
wp option patch insert stateless-modules gravity-form true || wp option add stateless-modules '{"gravity-form": "true"}' --format=json
wp plugin activate gravityforms
