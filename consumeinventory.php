<?php
	$value = $_POST['value'];
	$location = $_POST['location'];
	$condition = $_POST['condition'];
	$description = $_POST['description'];
	$db = mysql_connect("localhost", "inventory", "1nvp@ss") or die("Could not connect: " . mysql_error());
	mysql_select_db("inventory", $db) or die("Database not selectable:" . mysql_error());
	mysql_query("INSERT INTO `data` VALUES ('$description', '$location', '$condition', '$value')");
?>