#!/bin/bash

echo "Set GF settings..."
wp option add rg_gforms_key "$(echo "${GF_LICENSE}" | base64 -d)"
wp option add rg_gforms_enable_akismet 1
wp option add gform_enable_noconflict 1
wp option add gform_enable_background_updates 0
wp option add rg_gforms_enable_html5 1
