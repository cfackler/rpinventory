<?php
require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //Session

$link = connect();
if($link == null)
	die("Database connection failed");
	

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
	die("You dont have permission to access this page");
	

//id
$id = (int)$_GET["id"];
if($id == 0)
	die("Invalid ID");

	
//Create query
$sql = "Delete from locations where location_id = '" . $id . "'";

//Run update
if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: manageLocations.php');
	
?>