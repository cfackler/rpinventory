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


//Access level	
$access = (int)$_POST["access_level"];
if($access > 2 || $access < 0)
	die("Invalid access level");		
	
//id
$id = (int)$_POST["id"];
if($id == 0)
	die("Invalid ID");
	
	
//Create query
$sql = "Update logins set username = '" . $username . "', access_level = '" . $access . "'";

//Add password if changed
if(strlen($password) != 0)
{
	$pwd = md5($password);
	$sql .= ", password = '" . $pwd . "'";
}
	
$sql .= " where id = '" . $id . "'";


//Run update
if(!mysql_query($sql, $link))
	die("Query failed");

	
header('Location: manageusers.php');
	
?>