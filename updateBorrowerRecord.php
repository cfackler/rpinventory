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
	
//Name
$name = $_POST["name"];
if(strlen($name) == 0)
	die("Must have a name");

//RIN
$rin = $_POST["rin"];
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

//id
$id = (int)$_POST["id"];
if($id == 0)
	die("Invalid User ID");

$address_id = (int)$_POST['address_id'];
if($address_id == 0)
	die('Invalid Address ID');

/* Sanitize */
$name = mysqli_real_escape_string( $link, $name );
$rin = mysqli_real_escape_string( $link, $rin );
$email = mysqli_real_escape_string( $link, $email );
$address = mysqli_real_escape_string($link, $address);
$address2 = mysqli_real_escape_string($link, $address2);
$city = mysqli_real_escape_string($link, $city);
$state = mysqli_real_escape_string($link, $state);
$zip = mysqli_real_escape_string($link, $zip);
$phone = mysqli_real_escape_string($link, $phone);

//Create query
$sql = "UPDATE borrowers SET name = '" . $name . "', rin = '" . $rin . "', email = '" . $email . "' WHERE borrower_id = " . $id;

//Run update
if(!mysqli_query($link, $sql))
	die("Query failed");

$sql = "UPDATE addresses SET address = '". $address ."', address2 = '". $address2 . "', city = '". $city ."', state = '". $state ."', zipcode = '". $zip ."', phone = '". $phone ."' WHERE address_id = ". $address_id;

if(!mysqli_query($link, $sql))
	die('Query Failed');

mysqli_close($link);	
header('Location: manageBorrowers.php');
	
?>
