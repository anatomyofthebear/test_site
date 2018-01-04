<?php 
	$db_host = 'localhost';
	$db_user = 'root';
	$db_password = '';
	$db_name = 'test_db';

	$link = new mysqli($db_host, $db_user, $db_password, $db_name);

	if ($link->connect_error) {
    	 die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
	}
	$link->query("SET NAMES utf8",MYSQLI_STORE_RESULT);
?>