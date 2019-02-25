#!/bin/sh
wp config set --add --type=constant EP_HOST http://p4-es-elasticsearch-client.default.svc.cluster.local:9200
wp elasticpress deactivate-feature documents || true
wp elasticpress activate-feature documents || true
wp elasticpress index --show-bulk-errors || true