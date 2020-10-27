#!/bin/sh

# Disable some ElasticPress plugin features that don't work for us and affect performance.
wp elasticpress deactivate-feature facets
wp elasticpress deactivate-feature related_posts
