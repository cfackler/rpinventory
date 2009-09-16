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
$data = array("Found" => 'False', "Address" => '', "Address2" => '', "City" => '', "State" => '', "Zipcode" => '', "Phone" => '');

//GET ID
$username = mysqli_real_escape_string( $link, $_GET['username'] );
if( strlen( $username ) == 0)
  die("Invalid Username");	
	
//Address
$query= "SELECT *  FROM addresses, borrowers WHERE AND addresses.address_id = borrowers.address_id and borrowers.name = '". $username."'";
$result = mysqli_query($link, $query) or die( "Error finding address".mysql_error() );

if(mysqli_num_rows($result) != 0)
  {
    $item = mysqli_fetch_object($result);
    $data["Found"] = 'True';
	
    if($item->address != NULL)
      $data["Address"] = $item->address;
		
    if($item->address2 != NULL)
      $data["Address2"] = $item->address2;
		
    if($item->city != NULL)
      $data["City"] = $item->city;
		
    if($item->state != NULL)
      $data["State"] = $item->state;
		
    if($item->zipcode != NULL)
      $data["Zipcode"] = $item->zipcode;
		
    if($item->phone != NULL)
      $data["Phone"] = $item->phone;
  }

$json = new Services_JSON(); 

header('X-JSON: ('.$json->encode($data).')');

?>
