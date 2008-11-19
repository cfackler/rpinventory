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
$desc = $_POST["desc"];
if(strlen($desc) == 0)
	die("Must have a description");

//Condition
$condition = $_POST["condition"];
if(strlen($condition) == 0)
	die("Must have a condition");	

//Location	
$location = (int)$_POST["location"];
if($location == 0)
	die("Must have a location");		
	
//Value
$value = (double)$_POST["value"];
if($value == 0)
	die("Invalid Value");
	
//Item ID
$inventory_id = (int)$_POST["inventory_id"];
if($inventory_id == 0)
	die("Invalid item id");	
	
	
$query = "update inventory set description = '" . $desc . "', location_id = '" . $location . "', current_condition = '" . $condition . "', current_value = '" . $value . "' where inventory_id = '" . $inventory_id . "'";

//Run update
if(!mysqli_query($link, $query))
	die("Query failed");	
	



mysqli_close($link);

header('Location: viewinventory.php');

?>
