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

require_once('modules/json/JSON.php');
require_once("lib/auth.lib.php");   //Session

//Authenticate
$auth = GetAuthority();
if($auth < 1)
    die("You dont have permission to access this page");

if (!isset($_SESSION['club']))
{
    die('Could not get club id');
}

$club_id = $_SESSION['club'];

//JSON data 
$data = array("itemID" => '', "numRows" => 0);

// Check valid name
if ( !isset( $_GET['itemValue'] ) || $_GET['itemValue'] == '' ){
    die( 'Invalid Name' );
}

$itemValue = $_GET['itemValue'];

// Gets the ID of the form element to pass along
if ( !isset( $_GET['itemID'] ) || $_GET['itemID'] == '' ){
    die( 'Invalid item ID' );
}

$itemValue = trim($itemValue);

$data['itemID'] = $_GET['itemID'];
$data['itemValue'] = $itemValue;

$numRows = 0;

if ( $data['itemID'] == 'company' ){
    // Businesses
    $businesses = getBusinesses();

    foreach($businesses as &$business)
    {
        if (strcasecmp($business->company_name, $itemValue) == 0)
        {
            $numRows++;
        }
    }
}
else if ( $data['itemID'] == 'location' || preg_match( "/^newlocation[0-9]*$/", $data['itemID']) ){
    // Locations
    $locations = getLocations();

    foreach($locations as &$location)
    {
        if (strcasecmp($location->location, $itemValue) == 0)
        {
            $numRows++;
        }
    }
}
else if ( $data['itemID'] == 'location_edit' ){
    if( !isset( $_GET['locID'] )){
        die( 'Invalid location ID' );
    }

    $locID = $_GET['locID'];

    $locations = getLocations();

    // Make sure location doesn't already exist
    foreach($locations as &$location)
    {
        if ($location->location_id != $locID)
        {
            if (strcasecmp($location->location, $itemValue) == 0)
            {
                $numRows++;
            }
        }
    }
}
else {
    die( "Did not match a function to execute" );
}

$data['numRows'] = $numRows;

$json = new Services_JSON(); 

header('X-JSON: ('.$json->encode($data).')');

?>
