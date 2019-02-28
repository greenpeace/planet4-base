#!/bin/sh

ELASTICSEARCH_HOST=http://p4-es-elasticsearch-client.default.svc.cluster.local:9200/
wp config set --add --type=constant EP_HOST $ELASTICSEARCH_HOST
