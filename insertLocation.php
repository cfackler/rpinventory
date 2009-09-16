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

// Authenticate
$auth = GetAuthority();	
if($auth<1)
  die("Please login to complete this action");

$link = connect();
if($link == null)
  die("Database connection failed");

// Description
$desc = $_POST["description"];
if(strlen($desc) == 0)
  die("Must have a description");
	
// Location
$location = $_POST["location"];
if(strlen($location) == 0)
  die("Must have a location");

// Clean user input
$desc = mysqli_real_escape_string($link, $desc);
$location = mysqli_real_escape_string($link, $location);

$location = trim($location);

$sql = "SELECT location FROM locations";

$result = mysqli_query($link, $sql); 

// Make sure location doesn't already exist
while ($row = mysqli_fetch_array($result)) {
  if (strcasecmp($row['location'], $location) == 0){ 
    die("A location already exists with name, '" . $location ."'");
  }
}

$sql = "INSERT INTO locations (location_id, location, description) VALUES (NULL, '" . $location . "', '" . $desc . "')";
	
if(!mysqli_query($link, $sql))
  die("Query failed");

mysqli_close($link);
header('Location: manageLocations.php');
	
?>