#!/bin/bash

echo "Configure Google Profile Avatars plugin..."
wp option add gpavatars_options '{"gpa_license_key": ""}' --format=json || true
wp option patch update gpavatars_options gpa_license_key "${GOOGLE_PROFILE_AVATARS_KEY%$'\n'}"

# Temprary fix for upgrading the plugin with new zip filename
wp plugin deactivate google-profile-avatars
wp plugin activate googleprofileavatar-premium
