#!/bin/bash

echo "Deleting Custom CSS code..."
for p in $(wp post list --post_type=custom_css --field=ID); do
  wp post update "$p" --post_content=""
done
