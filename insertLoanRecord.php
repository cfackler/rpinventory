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

require_once("lib/auth.lib.php");  //Session
require_once('lib/borrowers.lib.php');
require_once('lib/addresses.lib.php');
require_once('lib/inventory.lib.php');
require_once('lib/loans.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
    die("You dont have permission to access this page");

//User
$borrower_id = (int)$_POST['borrower_id'];
if ($borrower_id == 0)
{
    die('Invalid User Id');
}

// Check if the borrower exists
if(!VerifyBorrowerExists($borrower_id, $db)) {
    die('Invalid Borrower');
}

//get on-loan location
$onLoanLocationId = (int)$_POST['location-0'];
if( $onLoanLocationId < 1 ) {
    die( 'Invalid location id' );
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
    
    if(is_null($item))
        die("Invalid item ID");

    $items[] = $item;
}


//Address INFO


$useOld = $_POST["useOld"];
$oldExists = false;
//Check if old address exists

$addressResult = getAddressFromBorrower($borrower_id, $db);

$address_id;
if(!is_null($addressResult))
{
    $oldExists = true;
    $address_id = $addressResult->address_id;
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


$timestamp = mktime(0, 0, 0, (int)$_POST["Date_Month"], (int)$_POST["Date_Day"], (int)$_POST["Date_Year"]);	
$date = date("Y-m-d", $timestamp);

foreach ($items as $item)
{
    // Create the loan
    addLoan($item->inventory_id, $borrower_id, $date, $item->current_condition, $item->location_id, $db);

    // Update the current location of the item
    updateInventoryLocation($item->inventory_id, $onLoanLocationId, $db);
}

$db->close();

header('Location: viewInventory.php');

?>
