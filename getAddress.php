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
require_once('lib/addresses.lib.php');
require_once('lib/borrowers.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();
if($auth < 1)
    die("You dont have permission to access this page");

//JSON data 
$data = array("Found" => 'False', "Address" => '', "Address2" => '', "City" => '', "State" => '', "Zipcode" => '', "Phone" => '');

//GET ID
$username = $_GET['username'];

if( strlen( $username ) == 0)
    die("Invalid Username");	

//Address
$borrower_id = getBorrowerId($username, $_SESSION['club'], $db);
$address = getAddressFromBorrower($borrower_id, $db);

if ($address != false)
{
    $data["Found"] = 'True';

    if($address->address != NULL)
        $data["Address"] = $address->address;

    if($address->address2 != NULL)
        $data["Address2"] = $addres->address2;

    if($address->city != NULL)
        $data["City"] = $address->city;

    if($address->state != NULL)
        $data["State"] = $address->state;

    if($address->zipcode != NULL)
        $data["Zipcode"] = $address->zipcode;

    if($address->phone != NULL)
        $data["Phone"] = $address->phone;
}

$json = new Services_JSON(); 

$db->close();

header('X-JSON: ('.$json->encode($data).')');

?>
