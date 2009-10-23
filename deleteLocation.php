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
if($auth < 1)
  die("You dont have permission to access this page");

$link = connect();
if($link == null)
  die("Database connection failed");
	
//id
$id = (int)$_GET["id"];
if($id == 0)
  die("Invalid ID");

//Verify no items use the location before deleting
$sql = "SELECT location_id FROM inventory WHERE location_id = '" . $id ."'";
$result= mysqli_query($link, $sql);
$numItems = mysqli_num_rows($result); 

if ( $numItems != 0) {
  die("Location still in use! Deletion will not be allowed until all inventory using this location are updated.");
}

// Make sure no items are loaned out that have the location as their original location
$sql = 'SELECT original_location_id FROM loans WHERE return_date is null AND original_location_id = '. $id;
$result = mysqli_query($link, $sql) or
    die("Query failed: ".mysqli_error($link));
$numItems = mysqli_num_rows($result);

$sql = 'SELECT original_location_id FROM checkouts WHERE time_returned is null AND original_location_id = '. $id;
$result2 = mysqli_query($link, $sql) or
    die("Query failed: ".mysqli_error($link));

if ( $numItems != 0 | mysqli_num_rows($result) != 0) {
  die("Loaned/Checked out item is stored at this location! Deletion will not be allowed until all inventory using this location are updated.");
}

//Create query
$sql = "DELETE FROM locations WHERE location_id = '" . $id . "'";

//Run update
if(!mysqli_query($link, $sql))
  die("Query failed");

mysqli_close($link);
header('Location: manageLocations.php');
	
?>
