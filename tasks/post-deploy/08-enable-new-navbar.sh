#!/bin/bash

# Update new navbar design on all dev sites
if [ "$APP_ENV" = "development" ]; then
  wp option patch insert planet4_options new_design_country_selector 'on'
  wp option patch insert planet4_options new_design_navigation_bar 'on'
  exit
fi

# All code below only runs on production/staging

# Catch NROs on non-gp.org domains
# ch, ummah, history, handbook, storytelling, gcefca
if [[ -n "${APP_HOSTPATH}" ]]; then
  echo "Excluded NRO: ${APP_HOSTNAME}"
  exit
fi

# Other NRO websites with customized navbar
excluded=(hongkong korea taiwan canada argentina japan belgium luxembourg denmark finland sweden norway)

nro="${APP_HOSTPATH}"
echo "NRO: ${nro}"

for i in "${excluded[@]}"; do
  if [ "$i" == "$nro" ]; then
    echo "Excluded NRO"
    exit
  fi
done

wp option patch insert planet4_options new_design_country_selector 'on'
wp option patch insert planet4_options new_design_navigation_bar 'on'
