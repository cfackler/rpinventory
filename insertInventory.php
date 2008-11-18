<?php
require_once("inc/connect.php");  //mysql

$link = connect();
if($link == null)
	die("Database connection failed");

	


//Description
$desc = $_POST["desc"];
if(strlen($desc) == 0)
	die("Must have a description");

//Condition
$condition = $_POST["condition"];
if(strlen($desc) == 0)
	die("Must have a description");	

//Location	
$location = (int)$_POST["location"];
if(strlen($desc) == 0)
	die("Must have a description");		
	
//Value
$value = (double)$_POST["value"];
if($value == 0)
	die("Invalid Value");
	
	
//Check location exists
$result=mysql_query("select * from locations where location_id=" . $location, $link);
//verify count
if(mysql_num_rows($result) == 0)
	die("Invalid Location");
	

	
$sql = "INSERT INTO inventory (inventory_id, description, location_id, current_condition, current_value) VALUES (NULL, '" . $desc . "', " . $location . ", '" . $condition . "', " . $value . ")";	
	
	
if(!mysql_query($sql, $link))
	die("Query failed");

	
header('Location: viewinventory.php');
	
?>