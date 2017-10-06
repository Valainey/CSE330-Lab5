<?php

$mysqli = new mysqli('localhost', 'root', '971028yyn', 'calendar');

if($mysqli-> connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>