#!/bin/sh

# Run wp cli command to convert shortcake shortcodes to gutenberg blocks.
wp cache flush
wp p4-gblocks convert_to_gutenberg
wp plugin deactivate planet4-plugin-blocks
wp cache flush
