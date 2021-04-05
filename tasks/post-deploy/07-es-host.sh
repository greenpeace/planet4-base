#!/bin/bash

if [ "$APP_ENV" = "development" ]; then
  wp option update ep_host "http://elasticsearch-data.elastic.svc.cluster.local:9200/"
  wp elasticpress index --setup
fi
