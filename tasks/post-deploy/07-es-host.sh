#!/bin/bash

if [ "$APP_ENVIRONMENT" = "development" ]; then
  wp option update ep_host "http://elasticsearch-data.elastic.svc.cluster.local:9200/"
fi
