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


// SMARTY Setup

require_once('inc/setup.php');

$smarty = new Smarty_Inv();

//users
$query= "SELECT purchases.purchase_id, purchases.business_id, purchases.purchase_date, company_name, total_price
	 FROM purchases, businesses
	 WHERE businesses.business_id=purchases.business_id ";
$result = mysqli_query($link, $query);
$purchases = array();
$items = array();

while($purchase = mysqli_fetch_object($result))
{
	$purchases [] = $purchase;
	
	
	$itemQuery = "select purchase_id, description from inventory, purchase_items where inventory.inventory_id = purchase_items.inventory_id and purchase_items.purchase_id = " . $purchase->purchase_id;

	$itemResult = mysqli_query($link, $itemQuery);
	$string = "";
	
	while($item = mysqli_fetch_object($itemResult))
	{
		if(strlen($string) != 0)
			$string .= ", ";
			
		$string .= $item->description;
	}
	
	$items[] = $string;
	
}


//BEGIN Page


	
//Assign vars
$smarty->assign('title', "View Purchases");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewPurchases');
$smarty->assign('purchases', $purchases);
$smarty->assign('purchaseItems', $items);

$smarty->display('index.tpl');



mysqli_close($link);

?>