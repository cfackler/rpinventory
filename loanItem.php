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
require_once('lib/locations.lib.php');

//Authenticate
$auth = GetAuthority();
if($auth < 1)
  die("You dont have permission to access this page");

$link = connect();
if($link == null)
  die("Database connection failed");
	
// SMARTY Setup
require_once('lib/smarty_inv.class.php');
$smarty = new Smarty_Inv();

//grab all ids
$idString = $_GET["ids"];
$token = strtok($idString, ",");
$idList = array();
$itemDesc = array();

while ($token !== false) {
  $idList[] = (int)$token;
  $token = strtok(",");
}

//Verify all ids are valid,  get item description
foreach ($idList as $id) {
  $result = mysqli_query($link, "SELECT description FROM inventory WHERE inventory_id = " . $id);
  if(mysqli_num_rows($result) == 0)
    die("Invalid item ID");
  
  $item = mysqli_fetch_object($result);
  $itemDesc[] = $item->description;
}

$itemsOut = array();

//Check Loan status
$loanedOut = false;

foreach ($idList as $id) {
  $loanQuery = "SELECT description FROM loans, inventory WHERE return_date is NULL and loans.inventory_id = inventory.inventory_id and loans.inventory_id = " . $id;
  $loanResult = mysqli_query($link, $loanQuery);
  if(mysqli_num_rows($loanResult) != 0) {
    $item = mysqli_fetch_object($loanResult);
    $itemsOut[] = $item->description;
    $loanedOut = true;
  }

  $checkoutQuery = "SELECT description from checkouts, inventory WHERE time_returned is NULL and checkouts.inventory_id = inventory.inventory_id and checkouts.inventory_id = " . $id;
  $checkoutResult = mysqli_query( $link, $checkoutQuery ) or
    die( 'Error getting inventory '.mysql_error() );
  if( mysqli_num_rows( $checkoutResult ) != 0 ){
    $item = mysqli_fetch_object( $checkoutResult );
    $itemsOut[] = $item->description;
    $loanedOut = true;
  }
}

//User list
$userQuery= "SELECT id, username FROM logins";
$userResult = mysqli_query($link, $userQuery);
$users = array();

while($user = mysqli_fetch_object($userResult)) {
  $users [] = $user;
}

//Locations
$locations = getLocationsOptions();

//BEGIN Page
	
//Assign vars
$smarty->assign('title', "Loan Items");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'loanItem');
$smarty->assign('itemDesc', $itemDesc);
$smarty->assign('itemsOut', $itemsOut);
$smarty->assign('idString', $idString);
$smarty->assign('users', $users);
$smarty->assign('loanedOut', $loanedOut);
$smarty->assign('selectDate', getdate(time()));
$smarty->assign('locations', $locations);

$smarty->display('index.tpl');

mysqli_close($link);

?>
