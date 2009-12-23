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
require_once('lib/inventory.lib.php');
require_once('lib/locations.lib.php');

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

// Chose to insert a new location
if($loc_id == -1)
{	
    //Description
    $newLocationDescription = $_POST["newLocationDescription"];
    if( strlen($newLocationDescription) == 0 )
        die("Must have a location description");

    //name
    $newLocationName = $_POST["newLocationName"];
    if(strlen($newLocationName) == 0)
        die("Must enter a location name");

    $loc_id = addLocation($newLocationName, $newLocationDescription);
}

//Value
$value = (double)$_POST["value"];
if($value == 0)
    die("Invalid Value");


//Check location exists
$location = getLocation($loc_id);

if (is_null($location))
{
    die("Invalid Location");
}

addInventory($desc, $loc_id, $condition, $value);

header('Location: viewInventory.php');

?>
