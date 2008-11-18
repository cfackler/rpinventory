<?php
	$value = $_POST['value'];
	$location = $_POST['location'];
	$condition = $_POST['condition'];
	$description = $_POST['description'];
	$db = mysql_connect("localhost", "inventory", "1nvp@ss") or die(mysql_error());
	mysql_select_db("rpinventory", $db) or die(mysql_error());
	mysql_query("INSERT INTO inventory VALUES ('$description', '$location', '$condition', '$value')");
	Print "database updated"
?>