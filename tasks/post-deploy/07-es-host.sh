#!/bin/bash

if [ "$APP_ENVIRONMENT" = "development" ]; then
  wp option update ep_host "http://elasticsearch-client.elastic.svc.cluster.local:9200/"
fi
