<?php

require "wp-config.php";

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);

// Check connection
if ($conn->connect_error) {
	http_response_code(503);
	die("Connection failed: " . $conn->connect_error);
}

http_response_code(200);
echo "ok";
$conn->close();