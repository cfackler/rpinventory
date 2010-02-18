<?php

/*

    Copyright (C) 2010, All Rights Reserved.

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

require_once("lib/auth.lib.php");  //Session
require_once('lib/checkouts.lib.php');
require_once('lib/inventory.lib.php');
require_once('lib/addresses.lib.php');
require_once('lib/borrowers.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
    die("You dont have permission to access this page");

// Borrower
$borrower_id = (int)$_POST['borrower_id'];

if ($borrower_id == 0)
{
    die('Invalid borrower');
}

if (!VerifyBorrowerExists($borrower_id, $db))
{
    die('Invalid borrower ID');
}


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
    $item = getInventoryItem($id, $db);

    if (is_null($item))
    {
        die('Invalid inventory item');
    }

    $items[] = $item;
}


//Address INFO


$useOld = $_POST["useOld"];
$oldExists = false;
//Check if old address exists

$address = getAddressFromBorrower($borrower_id, $db);
$address_id;

if (!is_null($address))
{
    $oldExists = true;
    $address_id = $address->address_id;
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
        $address_id = addAddress($address, $address2, $city, $state, $zipcode, $phone, $db);
    }
    else
    {
        updateAddress($address_id, $address, $address2, $city, $state, $zipcode, $phone, $db);
    }
}

$date = $_POST['time_taken'];
$event_name = $_POST['event_name'];
$event_location = $_POST['event_location'];

foreach ($items as $item)
{
    $checkoutId = addCheckout($item->inventory_id, $borrower_id, $date, $event_location, $event_name, $item->current_condition, $item->location_id, $db);

    updateInventoryLocation($item->inventory_id, 2, $db);
}

$db->close();

header('Location: viewInventory.php');

?>
