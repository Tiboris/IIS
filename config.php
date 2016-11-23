<?php
	define('DB_SERVER', 'sql209.byethost13.com');
	define('DB_USERNAME', 'b13_19161448');
	define('DB_PASSWORD', 'sufurki9');
	define('DB_DATABASE', 'b13_19161448_syriis');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	mysqli_set_charset($db,"utf8");
?>
