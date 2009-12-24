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

require_once("lib/auth.lib.php");  //Session
require_once('lib/locations.lib.php'); // Location library

// Authenticate
$auth = GetAuthority();	
if ($auth < 1)
{
    die("Please login to complete this action");
}

// Description
$desc = $_POST["description"];
if(strlen($desc) == 0)
  die("Must have a description");
	
// Location
$location = $_POST["location"];
if(strlen($location) == 0)
  die("Must have a location");

// Remove whitespace
$location = trim($location);
$desc = trim($desc);

// Get all of the stored locations
$locations = getLocations();

// Make sure we're not inserting a duplication location
foreach ($locations as &$loc)
{
    if (strcasecmp(stripslashes($loc->location), $location) == 0)
    {
        die('A location already exists with the name, "'. $location .'"');
    }
}

// Add the location
addLocation($location, $desc);

header('Location: manageLocations.php');
	
?>
