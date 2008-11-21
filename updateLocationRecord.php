<?php


require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //Session
require_once("inc/config.php");  //configs

$link = connect();
if($link == null)
	die("Database connection failed");
	
//Authenticate
$auth = GetAuthority();
if($auth < 1)
	die("You dont have permission to access this page");

	
//Description
$desc = $_POST["description"];
if(strlen($desc) == 0)
	die("Must have a description");
	
//Location
$location = $_POST["location"];
if(strlen($location) == 0)
	die("Must have a location");

	
//Location  ID
$location_id = (int)$_POST["location_id"];
if($location_id == 0)
	die("Invalid item id");	
	
	
$query = "update locations set description = '" . $desc . "', location = '" . $location . "' where location_id = " . $location_id;


//Run update
if(!mysqli_query($link, $query))
	die("Query failed");	
	



mysqli_close($link);

header('Location: manageLocations.php');

?>
