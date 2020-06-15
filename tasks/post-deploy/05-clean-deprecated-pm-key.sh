#!/bin/sh

# PLANET-4782
# List existing deprecated keys
echo "Usage of '_campaign_page_template' meta key..."
wp db query 'SELECT pm.*, pm2.meta_key as theme_key, pm2.meta_value as theme_value
    FROM wp_postmeta pm
    LEFT JOIN wp_postmeta pm2 ON (
      pm.post_id = pm2.post_id
      AND pm2.meta_key = "theme"
    )
    WHERE pm.meta_key="_campaign_page_template";'

# Convert deprecated keys to new keys if possible
echo "Replacing key with 'theme'"
wp db query 'UPDATE wp_postmeta
    SET meta_key = "theme"
    WHERE meta_key="_campaign_page_template"
      AND post_id NOT IN (
          SELECT * FROM(
            SELECT post_id
            FROM wp_postmeta pm
            WHERE meta_key="theme"
          ) AS e
      );'

# Delete left-over duplicates
echo "Deleting leftovers"
wp db query 'DELETE FROM wp_postmeta WHERE meta_key="_campaign_page_template";'

echo "Done."
