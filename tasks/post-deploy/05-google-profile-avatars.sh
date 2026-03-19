#!/bin/bash

echo "Configure Google Profile Avatars plugin..."
wp option add gpavatars_options '{"gpa_license_key": ""}' --format=json || true
wp option patch update gpavatars_options gpa_license_key "${GOOGLE_PROFILE_AVATARS_KEY%$'\n'}"

# Temporary fix for upgrading the plugin with new zip filename
wp plugin deactivate google-profile-avatars
wp plugin install --activate https://storage.googleapis.com/planet4-3rdparty-plugins/googleprofileavatar-premium-1.6.0.zip
