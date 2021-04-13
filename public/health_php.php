<?php
/**
 * TODO: The PHP Elastic APM agent won't have a ignore url functionality, hence added a below workaround,
 * https://github.com/elastic/apm-agent-php/issues/395
 */

use Elastic\Apm\ElasticApm;
if ( ini_get( 'elastic_apm.enabled' ) ) {
	ElasticApm::getCurrentTransaction()->discard();
}

echo "ok";
http_response_code(200);
