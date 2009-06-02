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

//id
$id = (int)$_GET["id"];
if($id == 0)
	die("Invalid ID");


//Loan status
$checkoutQuery = "Select description, current_condition, time_taken, checkout_id, inventory.inventory_id from inventory, checkouts where inventory.inventory_id = checkouts.inventory_id and checkout_id = " . $id;
$checkoutResult = mysqli_query($link, $checkoutQuery);

$status = "None";
if(mysqli_num_rows($checkoutResult) == 0)
	die("Invalid Checkout ID");

$checkoutItem = mysqli_fetch_object($checkoutResult);

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "Return Item");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'returnCheckout');
$smarty->assign('item', $checkoutItem);
$smarty->assign('loan_id', $id);
$smarty->assign('selectDate', getdate(time()));
$smarty->assign('dateTime', date('Y-m-d H:i:s') );

$smarty->display('index.tpl');


mysqli_close($link);

?>
