#!/bin/bash

# Update new navbar design on dev sites
if [ "$APP_ENV" = "development" ]; then
  wp option patch insert planet4_options new_design_country_selector 'on'
fi
