#!/bin/sh
wp config set --add --type=constant EP_HOST http://p4-es-elasticsearch-client.default.svc.cluster.local:9200
wp elasticpress activate-feature documents
wp elasticpress index --show-bulk-errors