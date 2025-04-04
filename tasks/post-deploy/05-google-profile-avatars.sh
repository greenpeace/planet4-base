#!/bin/bash

echo "Configure Google Profile Avatars plugin..."
wp option add gpavatars_options '{"gpa_license_key": ""}' --format=json || true
wp option patch update gpavatars_options gpa_license_key "${GOOGLE_PROFILE_AVATARS_KEY%$'\n'}"
wp plugin activate google-profile-avatars
