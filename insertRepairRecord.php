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
require_once("inc/auth.php");  //Session

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
	die("You dont have permission to access this page");


//Get item count
$count = (int)$_POST["count"];
if($count == 0)
	die("Must repair at least one item");


//Create loan records
for($x=0; $x<$count; $x++)
{
	//Date
    $timestamp = mktime(0, 0, 0, (int)$_POST["months" . $x], (int)$_POST["days" . $x], (int)$_POST["year" . $x]);	
	$date = date("Y-m-d", $timestamp);
	
	//Description
	$desc = $_POST["desc" . $x];
	if(strlen($desc) == 0)
		die("Must have a description");
		
	//Item ID
	$inventory_id = (int)$_POST["inventory_id" . $x];
	if($inventory_id == 0)
		die("Invalid item id");	
		
	//cost
	$cost = (double)$_POST["cost" . $x];
	if($cost == 0)
		die("Invalid Cost");
		
	//Biz id
	$buisnessId = (int)$_POST["buisnessId" . $x];
	if($buisnessId == 0)
		die("Invalid item id");		
	
		
		
	
	$sql = "INSERT INTO repairs (repair_id, inventory_id, business_id, repair_date, repair_cost, description) VALUES
	(NULL, " . $inventory_id . ", " . $buisnessId . ", '" . $date . "', " . $cost . ", '" . $desc . "'	)";	

    //echo $sql . "<br>";
		
	if(!mysqli_query($link, $sql))
		die("Query failed");
	
}

mysqli_close($link);
header('Location: viewinventory.php');
	
?>