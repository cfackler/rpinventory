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
require_once('lib/loans.lib.php');
require_once('lib/inventory.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
	die("You dont have permission to access this page");
	

//loan id
$loan_id = (int)$_POST["loan_id"];
if($loan_id == 0)
	die("Invalid Loan ID");

//Inventory ID
$inv_id = (int)$_POST["inv_id"];

//Original Location Id
$orig_loc_id = (int)$_POST["orig_loc_id"];
if( $orig_loc_id < 1 ) {
	die( 'Invalid Location Id' );
}

$condition = $_POST['condition'];
if (strlen($condition) == 0)
{
    die('Need a condition');
}

//Time
$timestamp = mktime(0, 0, 0, (int)$_POST["months"], (int)$_POST["days"], (int)$_POST["year"]);	
$date = date("Y-m-d", $timestamp);
	
	
// Return the loan
returnLoan($loan_id, $date, $db);

// Update the item condition
updateInventoryCondition($inv_id, $condition, $db);

// Reset the item location
updateInventoryLocation($inv_id, $orig_loc_id, $db);

$db->close();

header('Location: viewLoans.php');
	
?>
