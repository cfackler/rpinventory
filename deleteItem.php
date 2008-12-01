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
if($auth < 1)
	die("You dont have permission to access this page");
	
	
//grab all ids
$idString = $_GET["ids"];
$token = strtok($idString, ",");
$idList = array();

while ($token !== false) {
	$idList[] = (int)$token;
    $token = strtok(",");
}

//Run delete
foreach ($idList as $id)
{
	//Remove item
	$sql = "Delete from inventory where inventory_id = '" . $id . "'";

	//Run update
	if(!mysqli_query($link, $sql))
		die("Query failed");
		
		
	//Remove any loan records
	$sql = "Delete from loans where inventory_id = '" . $id . "'";

	//Run update
	if(!mysqli_query($link, $sql))
		die("Query failed");
}


mysqli_close($link);
header('Location: viewinventory.php');
	
?>