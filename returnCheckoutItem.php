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
require_once('lib/checkouts.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

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
$checkoutItem = getCheckout($id, $db);

if (is_null($checkoutItem))
{
    die('Invalid Checkout ID');
}

//Assign vars
$smarty->assign('title', "Return Item");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'returnCheckout');
$smarty->assign('checkoutItem', $checkoutItem);
$smarty->assign('loan_id', $id);
$smarty->assign('selectDate', getdate(time()));
$smarty->assign('dateTime', date('Y-m-d H:i:s') );

$smarty->display('index.tpl');

$db->close();

?>
