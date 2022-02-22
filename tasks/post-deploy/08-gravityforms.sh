#!/bin/bash

echo "Set GF settings..."
wp option add rg_gforms_key "${GF_LICENSE}" || wp option update rg_gforms_key "${GF_LICENSE}"
wp option add rg_gforms_enable_akismet 1 || true
wp option add gform_enable_noconflict 1 || true
wp option add gform_enable_background_updates 0 || true
wp option add rg_gforms_enable_html5 1 || true
