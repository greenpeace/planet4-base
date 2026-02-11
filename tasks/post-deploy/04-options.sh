#!/bin/bash

echo "Disable Attachment Pages..."
wp option set wp_attachment_pages_enabled 0

echo "Force to redirect to Google login page..."
wp option patch insert planet4_features enforce_sso on
