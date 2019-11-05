#!/bin/sh

# Set gutenberg editor as the default editor
wp option update classic-editor-replace 'block'

# Allow users to switch editors (classic - gutenberg)
wp option update classic-editor-allow-users 'disallow'
