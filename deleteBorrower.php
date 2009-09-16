<?php

/*

  Copyright (C) 2009, All Rights Reserved.

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
require_once("lib/connect.lib.php");  //mysql
require_once("lib/auth.lib.php");  //Session

//Authenticate
$auth = GetAuthority();	
if($auth != 2)
  die("You dont have permission to access this page");

$link = connect();
if($link == null)
  die("Database connection failed");

//id
$id = (int)$_GET["id"];
if($id == 0)
  die("Invalid ID");

// Get the address_id of the borrower
$sql = 'SELECT address_id FROM borrowers WHERE borrower_id = '. $id;
$result = mysqli_query($link, $sql);
$address_id = mysqli_fetch_object($result)->address_id;
	
//Remove login
$sql = "DELETE FROM borrowers WHERE borrower_id = '" . $id . "'";
if(!mysqli_query($link, $sql))
  die("Query failed");
	
// Remove the address
if(!mysqli_query($link, "DELETE FROM addresses WHERE address_id = " . $address_id))
  die("Query failed");

mysqli_close($link);
header('Location: manageBorrowers.php');
	
?>
