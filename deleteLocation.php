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
require_once('lib/inventory.lib.php');
require_once('lib/loans.lib.php');
require_once('lib/checkouts.lib.php');
require_once('lib/locations.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
    die("You dont have permission to access this page");

//id
$id = (int)$_GET["id"];
if($id == 0)
    die("Invalid ID");

//Verify no items use the location before deleting
$inventory = getInventoryFromLocation($id, $db);

if ( count($inventory) != 0) {
    die("Location still in use! Deletion will not be allowed until all inventory using this location are updated.");
}

// Make sure no items are loaned out that have the location as their original location
$loanItems = getActiveLoansByOriginalLocation($id, $db);
$numLoanItems = count($loanItems);

$checkoutItems = getActiveCheckoutsByOriginalLocation($id, $db);
$numCheckoutItems = count($checkoutItems);

if ( $numItems != 0 | $numCheckoutItems != 0)
{
    die("Loaned/Checked out item is stored at this location! Deletion will not be allowed until all inventory using this location are updated.");
}

deleteLocation($id, $db);

$db->close();

header('Location: manageLocations.php');

?>
