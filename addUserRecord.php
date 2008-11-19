<?php
require_once("inc/connect.php");  //mysql

$link = connect();
if($link == null)
	die("Database connection failed");


	
//Username
$username = $_POST["username"];
if(strlen($username) == 0)
	die("Must have a description");

//Password
$password = $_POST["password"];
if(strlen($password) == 0)
	die("Must have a password");

//Access level	
$access = (int)$_POST["access_level"];
if($access > 2 || $access < 0)
	die("Invalid access level");		



	
$sql = "INSERT INTO logins (id , username, password, access_level) VALUES (NULL, '" . $username . "', '" . md5($password) . "', " . $access . ")";	
	
if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: manageusers.php');
	
?>