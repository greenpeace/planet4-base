<?php

require "wp-config.php";

$redis = new Redis();

$redis_port = ! empty( $redis_server['port'] ) ? $redis_server['port'] : 6379;
$con   = $redis->connect($redis_server['host'], $redis_port);

if ( !$con ) {
	http_response_code(500);
	die("Redis not connected");
}
$redis->close();
echo "ok";
http_response_code(200);

