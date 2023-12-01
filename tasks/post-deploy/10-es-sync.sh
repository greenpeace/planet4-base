#!/bin/bash

echo "Delete existing Elasticsearch index and recreate it..."
wp elasticpress sync --setup --yes
