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
if($auth != 2)
  die("You dont have permission to access this page");
	

//Name
$name = $_POST['name'];
if(strlen($name) == 0)
	die('Must have a name');

//RIN
$rin = $_POST["RIN"];
if(strlen($rin) == 0)
  die("Must have a RIN");

//email
$email = $_POST["email"];
if(strlen($email) == 0)
  die("Must have a email");

$address = $_POST['address'];
if(strlen($address) == 0)
	die('Must have an address');

$address2 = $_POST['address2'];

$city = $_POST['city'];
if(strlen($city) == 0)
	die('Must have a city');

$state = $_POST['state'];
if(strlen($state) == 0)
	die('Must have a state');

$zip = $_POST['zip'];
if(strlen($zip) == 0)
	die('Must have a zipcode');

$phone = $_POST['phone'];
if(strlen($phone) == 0)
	die('Must have a phone number');

// Sanitize the query strings
$name = mysqli_real_escape_string($link, $name);
$rin = mysqli_real_escape_string($link, $rin);
$email = mysqli_real_escape_string($link, $email);
$address = mysqli_real_escape_string($link, $address);
$address2 = mysqli_real_escape_string($link, $address2);
$city = mysqli_real_escape_string($link, $city);
$state = mysqli_real_escape_string($link, $state);
$zip = mysqli_real_escape_string($link, $zip);
$phone = mysqli_real_escape_string($link, $phone);

// Insert the borrower
$sql = "INSERT INTO borrowers (borrower_id , rin, email, name) VALUES (NULL, '" . $rin . "', '" . $email . "', '" . $name ."')";	

if(!mysqli_query($link, $sql))
  die("Query failed");

$borrower_id = mysqli_insert_id($link);

// Insert the address
$sql = "INSERT INTO addresses (address_id, address, address2, city, state, zipcode, phone) VALUES (NULL, '". $address ."', '". $address2 ."', '". $city ."', '". $state ."', '". $zip ."', '". $phone ."')";

if(!mysqli_query($link, $sql))
	die('Query failed');

$address_id = mysqli_insert_id($link);

// Insert the link between address and borrower
$sql = "INSERT INTO borrower_addresses (user_id, address_id) VALUES (". $borrower_id .", ". $address_id .")";

if(!mysqli_query($link, $sql))
	die('Query failed');

mysqli_close($link);
header('Location: manageBorrowers.php');
	
?>
