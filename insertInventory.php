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
$desc = $_POST["desc"];
if(strlen($desc) == 0)
	die("Must have a description");

//Condition
$condition = $_POST["condition"];
if(strlen($condition) == 0)
	die("Must have a condition");	

//Location	
$location = (int)$_POST["location"];
if(strlen($location) == 0)
	die("Must have a location");		
	
//Value
$value = (double)$_POST["value"];
if($value == 0)
	die("Invalid Value");
	
	
//Check location exists
$result=mysqli_query($link, "select * from locations where location_id=" . $location);
//verify count
if(mysqli_num_rows($result) == 0)
	die("Invalid Location");
	

	
$sql = "INSERT INTO inventory (inventory_id, description, location_id, current_condition, current_value) VALUES (NULL, '" . $desc . "', " . $location . ", '" . $condition . "', " . $value . ")";		
	
if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: viewinventory.php');
	
?>