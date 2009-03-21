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

include_once('JSON.php');
require_once("lib/connect.lib.php");  //mysql
require_once("lib/auth.lib.php");   //Session

//Authenticate
$auth = GetAuthority();
if($auth < 1)
  die("You dont have permission to access this page");
	
$link = connect();
if($link == null)
  die("Database connection failed");
	
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

$itemValue = mysqli_real_escape_string($link, $itemValue);

$itemValue = trim($itemValue);

$data['itemID'] = $_GET['itemID'];
$data['itemValue'] = $itemValue;

$numRows = 0;

if ( $data['itemID'] == 'company' ){
  // Business Query
  $sql = "SELECT company_name FROM businesses";
  $result = mysqli_query($link, $sql);
  
  // Count rows in result that match case-insensitively
  while( $row = mysqli_fetch_array( $result ) ){
    if( strcasecmp( $row['company_name'], $itemValue ) == 0 )
      $numRows++;
  }
}
else if ( $data['itemID'] == 'location' ){
  // Location query
  $sql = "SELECT location FROM locations";
  
  $result = mysqli_query($link, $sql); 

  // Make sure location doesn't already exist
  while ($row = mysqli_fetch_array($result)) {
    if (strcasecmp($row['location'], $itemValue) == 0){ 
      $numRows++;
    }
  }
}
else if ( $data['itemID'] == 'location_edit' ){
  if( !isset( $_GET['locID'] )){
      die( 'Invalid location ID' );
  }

  $locID = mysqli_real_escape_string( $link, $_GET['locID'] );

  // Location query, excluding itself
  $sql = "SELECT location FROM locations WHERE location_id != '" . $locID . "'";

  $result = mysqli_query($link, $sql); 

  // Make sure location doesn't already exist
  while ($row = mysqli_fetch_array($result)) {
    if (strcasecmp($row['location'], $itemValue) == 0){ 
      $numRows++;
    }
  }
}

$data['numRows'] = $numRows;

$json = new Services_JSON(); 

header('X-JSON: ('.$json->encode($data).')');

?>