#!/bin/bash

if [[ -n "${APP_HOSTPATH}" ]]; then
  echo "\"^/${APP_HOSTPATH}/(.*/)sitemap.xml\",\"https://${APP_HOSTNAME}/${APP_HOSTPATH}/\$1wp-sitemap.xml\"" >sitemap.csv
else
  echo "\"^/(.*/)sitemap.xml\",\"https://${APP_HOSTNAME}/\$1wp-sitemap.xml\"" >sitemap.csv
fi
wp redirection import sitemap.csv --format=csv
