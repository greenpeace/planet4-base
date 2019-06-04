#!/bin/sh
echo "List of tables before deleting searchWP tables:"
wp db query 'SHOW TABLES LIKE "wp_swp_%"'

wp db query 'DROP TABLE IF EXISTS wp_swp_cf'
wp db query 'DROP TABLE IF EXISTS wp_swp_index'
wp db query 'DROP TABLE IF EXISTS wp_swp_log'
wp db query 'DROP TABLE IF EXISTS wp_swp_cf'
wp db query 'DROP TABLE IF EXISTS wp_swp_tax'
wp db query 'DROP TABLE IF EXISTS wp_swp_terms'

echo "List of tables after deleting searchWP tables:"
wp db query 'SHOW TABLES LIKE "wp_swp_%"'
