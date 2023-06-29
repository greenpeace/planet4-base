#!/bin/bash

echo "Override staging robots file..."
if [ "$APP_ENV" = "staging" ]; then
  echo "User-agent: *" >source/public/robots.txt
  echo "Disallow: /" >>source/public/robots.txt
fi
