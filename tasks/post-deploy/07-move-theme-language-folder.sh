#!/bin/bash

echo "Copy Master theme language translation files to WP language dir..."
rsync -ar public/wp-content/themes/planet4-master-theme/languages/ public/wp-content/languages/themes/
