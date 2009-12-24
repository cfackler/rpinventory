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
require_once('lib/locations.lib.php');

//Authenticate
$auth = GetAuthority();
if($auth < 1)
	die("You dont have permission to access this page");

//Description
$desc = $_POST["description"];
if(strlen($desc) == 0)
	die("Must have a description");
	
//Location
$location_name = $_POST["location_edit"];
if(strlen($location_name) == 0)
	die("Must have a location");

	
//Location  ID
$location_id = (int)$_POST["location_id"];
if($location_id == 0)
	die("Invalid item id");	

// Location query, excluding itself
$locations = getLocations();

$numRows = 0;

// Make sure location doesn't already exist
foreach($locations as &$location)
{
    if ($location_id != $location->location_id)
    {
        if (strcasecmp($location->location, $location_name) == 0)
        {
            $numRows++;
        }
    }
}

// If true, location is a duplicate
if ( $numRows > 0 ){
  die('A location already exists with the name ' . $location );
}

// Update the location
updateLocation($location_id, $location_name, $desc);

header('Location: manageLocations.php');

?>
