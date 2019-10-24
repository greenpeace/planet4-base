#!/bin/sh

# Run wp cli command to convert shortcake shortcodes to gutenberg blocks.
wp cache flush
wp p4-gblocks convert_to_gutenberg
wp plugin deactivate planet4-plugin-blocks
wp cache flush

# Install dependencies for nodejs
apt-get update
apt-get install gnupg -y
curl -sL https://deb.nodesource.com/setup_10.x | bash -
apt-get install nodejs -y

# Clone convert-to-gutenberg repo, install npm packages
cd /tmp || exit
git clone https://github.com/greenpeace/planet4-convert-to-gutenberg
cd planet4-convert-to-gutenberg || exit
sed 's|/path/to/wordpress/public/|/app/source/public|g' config.example.json > config.json
npm install

#  Run core block gutenberg conversion
node convert-blocks.js page
wp cache flush
node convert-blocks.js post
wp cache flush
node convert-blocks.js campaign
wp cache flush

# Clean up
apt-get remove nodejs -y
