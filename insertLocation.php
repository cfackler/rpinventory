<?php
require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //Session

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();	

if($auth<1)
	die("Please login to complete this action");

//Description
$desc = $_POST["description"];
if(strlen($desc) == 0)
	die("Must have a description");
	
//Location
$location = $_POST["location"];
if(strlen($location) == 0)
	die("Must have a location");


	
$sql = "INSERT INTO locations (location_id, location, description) VALUES (NULL, '" . $location . "', '" . $desc . "')";

	
if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: manageLocations.php');
	
?>