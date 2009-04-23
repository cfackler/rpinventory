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
require_once("lib/interface.lib.php"); //interface functions

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();	


// SMARTY Setup

require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();

// Decide sorting method
if(isset($_GET['sort']) && ($_GET['sort'] >= 0 && $_GET['sort'] <= 4))
  $currentSortIndex = $_GET['sort'];
else
  $currentSortIndex = 0;

//Decide sorting direction
if(isset($_GET['sortdir']) && $_GET['sortdir'] == 1)
  $currentSortDir = 1;
else
  $currentSortDir = 0;
  
  
  
/**
 * SQL
 **/
 
 /* Determine query argument for sorting */
if($currentSortIndex == 0)
  $sortBy = 'purchase_id';
else if($currentSortIndex == 1)
  $sortBy = 'company_name';
else if($currentSortIndex == 2)
  $sortBy = 'purchase_date';
else if($currentSortIndex == 3)
  $sortBy = 'total_price';

/*  Determine query argument for sort direction
    Ascending is default    */
if($currentSortDir == 1)
  $sortBy .= ' DESC';

//users
$query= "SELECT purchases.purchase_id, purchases.business_id, purchases.purchase_date, company_name, total_price
	 FROM purchases, businesses
	 WHERE businesses.business_id=purchases.business_id ORDER BY ".$sortBy;
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
mysqli_close($link);







//BEGIN Page

/* Table column headers */
$headers = array();
$headers[0] = array('label' => 'Items', 'width' => 150);
$headers[1] = array('label' => 'Company Name', 'width' => 250);
$headers[2] = array('label' => 'Date', 'width' => 125);
$headers[3] = array('label' => 'Total Cost', 'width' => 150);

	
//Assign vars
$smarty->assign('headers', $headers);
$smarty->assign('currentSortIndex', $currentSortIndex);
$smarty->assign('currentSortDir', $currentSortDir);
$smarty->register_function('generateTableHeader', 'generateTableHeader');
  
$smarty->assign('title', "View Purchases");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewPurchases');
$smarty->assign('purchases', $purchases);
$smarty->assign('purchaseItems', $items);

$smarty->display('index.tpl');




?>