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

require_once("lib/connect.lib.php");  // mysql
require_once("lib/auth.lib.php");  // Session

// Authenticate
$auth = GetAuthority();	
if($auth<1)
  die("Please login to complete this action");

$link = connect();
if($link == null)
  die("Database connection failed");

// Company name
$company = $_POST["company"];
if(strlen($company) == 0)
  die("Must have a name");
	
// Address
$address = $_POST["address"];
if(strlen($address) == 0)
  die("Must have an address");

$address2 = $_POST["address2"];

// City
$city = $_POST["city"];
if(strlen($city) == 0)
  die("Must have a city");

// State
$state = $_POST["state"];
if(strlen($state) == 0)
  die("Must have a state");

// Zip Code
$zip = $_POST["zip"];
if(strlen($zip) == 0)
  die("Must have a zip code");

// Contact info
$phone = $_POST["phone"];
$fax = $_POST["fax"];
$email = $_POST["email"];
if(strlen($phone) == 0 && strlen($fax) == 0 && strlen($email) == 0)
  die("Must have contact information");

$website = $_POST["website"];

// Add correct 'http://' at beginning on URL 
$website = preg_replace('/^(http:\/\/)*(.+)$/i', 'http://$2', $website); 

// Clean user input
$address = mysqli_real_escape_string($link, $address);
$address2 = mysqli_real_escape_string($link, $address2);
$city = mysqli_real_escape_string($link, $city);
$state = mysqli_real_escape_string($link, $state);
$zip = mysqli_real_escape_string($link, $zip);
$phone = mysqli_real_escape_string($link, $phone);
$company = mysqli_real_escape_string($link, $company);
$fax = mysqli_real_escape_string($link, $fax);
$email = mysqli_real_escape_string($link, $email);
$website = mysqli_real_escape_string($link, $website);

$company = trim($company);

// Prevent Businesses with the same names (case insensitive)
$sql = "SELECT * FROM businesses";

$result = mysqli_query($link, $sql);
$checkRows = 0;

// Case insensitive search 
while ( $row = mysqli_fetch_array($result) ){
  if (  strcasecmp( $company, $row['company_name'] ) == 0 )
    $checkRows++;
}

// Die if we find another
if ( $checkRows > 0 ){
  die("A businesses already exists with name '" . $company . "'. Please enter a different company name.");
}

$sql = "INSERT INTO addresses (address_id, address, address2, city, state, zipcode, phone) VALUES (NULL, '" . $address . "', '" . $address2 . "', '" . $city . "', '" . $state . "', '" . $zip . "', '" . $phone . "')";
		
if(!mysqli_query($link, $sql))
  die("Query failed first");

$address_id = mysqli_insert_id($link);

$sql = "INSERT INTO businesses (business_id, address_id, company_name, fax, email, website) VALUES (NULL, '" . $address_id . "' , '" . $company . "', '" . $fax . "', '" . $email . "', '" . $website . "')";

if(!mysqli_query($link, $sql))
  die("Query failed second");

mysqli_close($link);
header('Location: viewBusinesses.php');
	
?>
