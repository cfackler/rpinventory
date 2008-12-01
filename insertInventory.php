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
    along with Foobar.  If not, see <http://www.gnu.org/licenses/>.

*/

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