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
$items = array();
foreach ($idList as $id)
{
	$result = mysqli_query($link, "select * from inventory where inventory_id = " . $id);
	if(mysqli_num_rows($result) == 0)
		die("Invalid item ID");
	
	$item = mysqli_fetch_object($result);
	$items[] = $item;
}


	

//businesses list
$bizQuery= "SELECT company_name, business_id FROM businesses";
$bizResult = mysqli_query($link, $bizQuery);
$businesses = array();

while($biz = mysqli_fetch_object($bizResult))
{
	$businesses [] = $biz;
}

//BEGIN Page


	
//Assign vars
$smarty->assign('title', "Repair Items");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'repairItems');
$smarty->assign('items', $items);
$smarty->assign('itemCount', count($items));
$smarty->assign('idString', $idString);
$smarty->assign('businesses', $businesses);
$smarty->assign('selectDate', getdate(time()));

$smarty->display('index.tpl');



mysqli_close($link);

?>
