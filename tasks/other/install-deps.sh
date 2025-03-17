#!/usr/bin/env bash

pushd /app/source/public/wp-content/themes/planet4-master-theme || exit
npm install
npm run build
composer install
popd || exit

