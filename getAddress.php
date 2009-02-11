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
require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");   //Session

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
$id = (int)$_GET['id'];
if($id == 0)
  die("Invalid ID");	
	
//Address
$query= "SELECT *  FROM addresses, borrower_addresses WHERE addresses.address_id = borrower_addresses.address_id and borrower_addresses.user_id = " . $id;
$result = mysqli_query($link, $query);

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

//echo $json->encode($data);

//print_r($data);

?>