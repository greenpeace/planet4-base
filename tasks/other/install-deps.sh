#!/usr/bin/env bash

pushd /app/source/public/wp-content/themes/planet4-master-theme || exit
npm install
npm run build
composer install
popd || exit

for plugin in gutenberg-blocks gutenberg-engagingnetworks
do
	pushd /app/source/public/wp-content/plugins/planet4-plugin-${plugin} || exit
	npm install
	npm run build
	composer install
	popd || exit
done