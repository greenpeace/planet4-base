#!/bin/sh

if [ "$APP_ENV" = "development" ]; then
  wp core update --version=5.8.1
  wp core update-db
fi
