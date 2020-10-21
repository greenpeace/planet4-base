#!/bin/sh

# Get posts that use the media block and have a poster
wp db query "SELECT ID, post_title FROM wp_posts WHERE post_status = 'publish'AND post_content LIKE '%video_poster_img%'"
