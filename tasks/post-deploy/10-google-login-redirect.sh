#!/bin/bash

echo "Force to redirect to Google login page..."
wp eval 'update_option("planet4_options", array_merge(get_option("planet4_options", []), ["enforce_sso" => true]));'
