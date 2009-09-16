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

$link = connect();
if($link == null)
  die("Database connection failed");

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
  die("You dont have permission to access this page");



//User
$user_name = mysqli_real_escape_string( $link, $_POST["username"] );
if($user_name == "")
  die("Invalid Username");

$user_id;

$sql = 'SELECT borrower_id FROM borrowers WHERE name = "'.$user_name.'" LIMIT 1';

$result = mysqli_query( $link, $sql ) or
  die( 'Invalid user id found'.mysqli_error($link) );
$result = mysqli_fetch_object( $result );
$user_id = $result->borrower_id;

if(!VerifyUserExists($user_id, $link))
  die("Invalid User");


//grab all ids
$idString = $_POST["inventory_ids"];
$token = strtok($idString, ",");
$idList = array();

while ($token !== false) {
  $idList[] = (int)$token;
  $token = strtok(",");
}

$items = array();

//Verify all ids are valid
foreach ($idList as $id)
  {
    $result = mysqli_query($link, "select current_condition, inventory_id, location_id from inventory where inventory_id = " . $id);
    if(mysqli_num_rows($result) == 0)
      die("Invalid item ID:");
    
    $item = mysqli_fetch_object($result);
    $items[] = $item;
  }


//Address INFO


$useOld = $_POST["useOld"];
$oldExists = false;
//Check if old address exists

$query= "SELECT *  FROM addresses, borrowers WHERE addresses.address_id = borrowers.address_id and borrowers.borrower_id = " . $user_id . " LIMIT 1";
$result = mysqli_query($link, $query);
$addyResult = null;
$address_id;
if(mysqli_num_rows($result) != 0)
{
  $oldExists = true;
  $addyResult = mysqli_fetch_object($result);
  $address_id = $addyResult->address_id;
}



if($useOld == "on")
  {
    if($oldExists == false)
      die("Old address doesnt exist");
  }   
else
  {
    
    $address = $_POST["address"];
    $address2 = $_POST["address2"];
    if($address2 == null)
      $address2="";
    
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zipcode = $_POST["zipcode"];
    $phone = $_POST["phone"];
    
    if(strlen($address) == 0 || strlen($city) == 0 || strlen($state) == 0 || strlen($zipcode) == 0 || strlen($phone) == 0)
      die("Null values not allowed");
    
    if(!$oldExists)
      {
		  $query = "insert into addresses (address_id, address, address2, city, state, zipcode, phone) VALUES(NULL, '" . $address . "', '" . $address2 . "', '" . $city . "', '" . $state . "', '" . $zipcode . "', '" . $phone . "')";
	
		  if(!mysqli_query($link, $query))
			  die("Query failed insert address");
		  $address_id = mysqli_insert_id($link);
	  }

	$query = "update addresses set address='" . $address . "', address2='" . $address2 . "', city='" . $city . "', state='" . $state . "', zipcode='" . $zipcode . "', phone='" . $phone . "' where address_id = " . $address_id;


	if(!mysqli_query($link, $query))
		die("Query failed Update Address");

  }

$date = mysqli_real_escape_string( $link, $_POST['time_taken'] );
$event_name = mysqli_real_escape_string( $link, $_POST['event_name'] );
$event_location = mysqli_real_escape_string( $link, $_POST['event_location'] );

foreach ($items as $item)
  {
    $sql = "INSERT INTO checkouts (checkout_id, inventory_id, borrower_id, time_taken, time_returned, event_name, event_location, starting_condition, ending_condition, original_location_id) VALUES
	(NULL, " . $item->inventory_id . ", " . $user_id . ", '" . $date . "', NULL, '". $event_location ."', '". $event_name ."', '" . $item->current_condition . "', NULL, '". $item->location_id ."' )";	
    
    if(!mysqli_query($link, $sql))
      die("Query failed Checkouts ". mysql_error());

    $sql = 'UPDATE inventory SET location_id = 2 WHERE inventory_id = ' . $item->inventory_id;

    if(!mysqli_query($link, $sql)){ 
        die('Update query failed');
    }    
  }

mysqli_close($link);
header('Location: viewInventory.php');
	
?>
