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
require_once("inc/auth.php");   //Session
require_once("inc/config.php"); //configs

$link = connect();
if($link == null)
   die("Database connection failed");

// Authenticate
$auth = GetAuthority();

// SMARTY Setup
require_once('inc/setup.php');

$smarty = new Smarty_Inv();

//items
$query = "SELECT username, name, rin, email, address, city, state, zipcode, phone
                 FROM logins, borrower_addresses, addresses
		 WHERE addresses.address_id=borrower_addresses.address_id AND
		       borrower_addresses.user_id=logins.id";
                 
$result = mysqli_query($link, $query);
$borrowers = array();

while($item = mysqli_fetch_object($result))
{
	$borrowers [] = $item;
}

//BEGIN Page


$smarty->assign('title', "View Borrowers");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewBorrowers');
$smarty->assign('borrowers', $borrowers);


$smarty->display('index.tpl');

mysqli_close($link);

?>