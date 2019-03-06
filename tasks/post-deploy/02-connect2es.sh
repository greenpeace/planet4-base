#!/bin/sh

ELASTICSEARCH_HOST=http://p4-es-elasticsearch-client.default.svc.cluster.local:9200/
wp option update ep_host $ELASTICSEARCH_HOST
