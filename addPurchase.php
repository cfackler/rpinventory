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


require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //Session
require_once("inc/config.php");  //configs

$link = connect();
if($link == null)
	die("Database connection failed");
	
//Authenticate
$auth = GetAuthority();
if($auth < 1)
	die("You dont have permission to access this page");

// SMARTY Setup

require_once('inc/setup.php');

$smarty = new Smarty_Inv();

$count = (int)$_GET['count'];



//Business List

$businessQuery = "SELECT business_id, company_name FROM businesses";
$businessResult = mysqli_query($link, $businessQuery);
$businesses = array();

while($business = mysqli_fetch_object($businessResult))
{
	$businesses [] = $business;
}

//inventory list
$itemQuery= "SELECT inventory_id, description FROM inventory";
$itemResult = mysqli_query($link, $itemQuery);
$items = array();

while($item = mysqli_fetch_object($itemResult))
{
	$items [] = $item;
}

//Locations
$locQuery= "SELECT location_id, location  FROM locations";
$locResult = mysqli_query($link, $locQuery);
$locations = array();

while($loc = mysqli_fetch_object($locResult))
{
	$locations [] = $loc;
}

//BEGIN Page


	
//Assign vars
$smarty->assign('title', "Purchase Items");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'addPurchase');
//$smarty->assign('items', $items);
$smarty->assign('count', $count);
$smarty->assign('businesses', $businesses);
$smarty->assign('selectDate', getdate(time()));
$smarty->assign('locations', $locations);

$smarty->display('index.tpl');



mysqli_close($link);

?>
