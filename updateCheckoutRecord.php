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
require_once('lib/inventory.lib.php');
require_once('lib/checkouts.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
	die("You dont have permission to access this page");
	

//loan id
$checkout_id = (int)$_POST["checkout_id"];
if( $checkout_id  == 0 ){
  die("Invalid Checkout ID");
}

//Inventory ID
$inv_id = (int)$_POST["inv_id"];

$time_returned = $_POST["time_returned"];
$condition = $_POST['condition'];

if( $time_returned == '' ){
  die( 'Invalid Return Time' );
}

// Get location
$checkout = getCheckout($checkout_id, $db);
	
// Update the checkout
updateCheckout($checkout_id, $time_returned, $condition, $db);

// Update inventory
updateInventoryLocation($inv_id, $checkout->original_location_id, $db);
updateInventoryCondition($inv_id, $condition, $db);

$db->close();

header('Location: viewCheckouts.php');
	
?>
