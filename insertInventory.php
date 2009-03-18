<?php

/*

    Copyright (C) 2008, All Rights Reserved.

    This file is part of RPInventory.

    RPInventory is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    RPInventory is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with RPInventory.  If not, see <http://www.gnu.org/licenses/>.

*/

require_once("inc/connect.php");  //mysql
require_once("lib/auth.lib.php");  //Session

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
$loc_id = (int)$_POST["location_id"];

$sql = "SELECT location_id FROM locations";

$result = mysqli_query($link, $sql);
$numLocations = mysqli_num_rows($result);

// Chose to insert a new location
if($loc_id == -1){	

	//Description
	$newLocationDescription = $_POST["newLocationDescription"];
	if(strlen($newLocationDescription) == 0)
	  die("Must have a location description");
	 //name
	 $newLocationName = $_POST["newLocationName"];
	 if(strlen($newLocationName) == 0)
	 	die("Must enter a location name");

	//Insert the Location in DB
	$query = "insert into locations (location_id, location, description) VALUES(NULL, '" . $newLocationName . "', '" . $newLocationDescription . "')";
		
	if(!mysqli_query($link, $query))
	  die("Query failed first");
	
	//change loc_id to new location
	$loc_id = mysqli_insert_id($link);
}
	
	
//Value
$value = (double)$_POST["value"];
if($value == 0)
	die("Invalid Value");
	
	
//Check location exists
$result=mysqli_query($link, "select * from locations where location_id=" . $loc_id);
//verify count
if(mysqli_num_rows($result) == 0)
	die("Invalid Location");
	

	
$sql = "INSERT INTO inventory (inventory_id, description, location_id, current_condition, current_value) VALUES (NULL, '" . $desc . "', " . $loc_id . ", '" . $condition . "', " . $value . ")";		
	
if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: viewInventory.php');
	
?>