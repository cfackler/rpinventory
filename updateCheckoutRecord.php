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

require_once("lib/connect.lib.php");  //mysql
require_once("lib/auth.lib.php");  //Session

$link = connect();
if($link == null)
	die("Database connection failed");

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

if( $time_returned == '' ){
  die( 'Invalid Return Time' );
}
	
//Create query for returning item
$sql = "Update checkouts set time_returned = '" . $date . "' where checkout_id = " . $checkout_id;

//Run update
if(!mysqli_query($link, $sql))
	die("Query failed");

//Create query for updating item condition
$sql = "UPDATE inventory SET current_condition = '". $_POST["condition"] . "' WHERE inventory_id = " . $inv_id;

if(!mysqli_query($link, $sql))
        die("Query failed");


mysqli_close($link);	
header('Location: viewCheckouts.php');
	
?>