#!/usr/bin/env bash

[ -x "$(command -v npm)" ] || { >&2 echo "npm is required but not installed, exiting."; exit 1; }

pushd /app/source/public/wp-content/themes/planet4-master-theme || exit
npm run build
popd || exit

pushd /app/source/public/wp-content/plugins/planet4-plugin-gutenberg-blocks || exit
npm run build
popd || exit
