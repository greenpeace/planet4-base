#!/bin/bash

for i in $(wp post list --post_type=campaign --format=ids)
do
    wp post meta set "$i" p4_hide_page_title_checkbox on
done
