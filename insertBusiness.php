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

require_once("lib/auth.lib.php");  // Session
require_once('lib/addresses.lib.php');
require_once('lib/businesses.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

// Authenticate
$auth = GetAuthority();	
if ($auth<1)
{
    die("Please login to complete this action");
}

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
if (strlen($city) == 0)
{
    die("Must have a city");
}

// State
$state = $_POST["state"];
if (strlen($state) == 0)
{
    die("Must have a state");
}

// Zip Code
$zip = $_POST["zip"];
if (strlen($zip) == 0)
{
    die("Must have a zip code");
}

// Contact info
$phone = $_POST["phone"];
$fax = $_POST["fax"];
$email = $_POST["email"];

if (strlen($phone) == 0 || strlen($fax) == 0 || strlen($email) == 0)
{
    die("Must have contact information");
}

$website = $_POST["website"];

// Add correct 'http://' at beginning on URL 
$website = preg_replace('/^(http:\/\/)*(.+)$/i', 'http://$2', $website); 

$company = trim($company);

$businesses = getBusinesses($db);

// Case insensitive search 
foreach($businesses as &$business)
{
    // Die if we find another
    if (strcasecmp($company, $business->company_name) == 0)
    {
        die("A businesses already exists with name '" . $company . "'. Please enter a different company name.");
    }
}


$address_id = addAddress($address, $address2, $city, $state, $zip, $phone, $db);

$bus_id = addBusiness($address_id, $company, $fax, $email, $website, $db);

$db->close();

header('Location: viewBusinesses.php');

?>
