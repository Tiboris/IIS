<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'xdudla00');
	define('DB_PASSWORD', 'areku4an');
	define('DB_DATABASE', 'xdudla00');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	mysqli_set_charset($db,"utf8");
?>
