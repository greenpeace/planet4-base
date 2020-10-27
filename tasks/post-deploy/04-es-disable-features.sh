#!/bin/sh

# Disable certain ES plugin features
wp elasticpress deactivate-feature facets
wp elasticpress deactivate-feature related_posts
