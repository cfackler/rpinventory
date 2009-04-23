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
require_once("lib/auth.lib.php");   //Session
require_once("lib/interface.lib.php"); //interface functions

$link = connect();
if($link == null)
   die("Database connection failed");

// Authenticate
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
 * Move all of this to a function eventually
 **/
 
/* Determine query argument for sorting */
if($currentSortIndex == 0)
  $sortBy = 'name';
else if($currentSortIndex == 1)
  $sortBy = 'rin';
else if($currentSortIndex == 2)
  $sortBy = 'email';
else if($currentSortIndex == 3)
  $sortBy = 'address';
else if($currentSortIndex == 4)
  $sortBy = 'phone';

/*  Determine query argument for sort direction
    Ascending is default    */
if($currentSortDir == 1)
  $sortBy .= ' DESC';

//items
$query = "SELECT username, name, rin, email, address, city, state, zipcode, phone
    FROM logins, borrower_addresses, addresses
		 WHERE addresses.address_id=borrower_addresses.address_id AND
		       borrower_addresses.user_id=logins.id
		      ORDER BY ".$sortBy;
                 
$result = mysqli_query($link, $query);
$borrowers = array();

while($item = mysqli_fetch_object($result))
{
	$borrowers [] = $item;
}





/* Table column headers */
$headers = array();
$headers[0] = array('label' => 'Name', 'width' => 150);
$headers[1] = array('label' => 'RIN', 'width' => 100);
$headers[2] = array('label' => 'Email', 'width' => 150);
$headers[3] = array('label' => 'Address', 'width' => 200);
$headers[4] = array('label' => 'Phone', 'width' => 100);

//BEGIN Page
$smarty->assign('headers', $headers);
$smarty->assign('currentSortIndex', $currentSortIndex);
$smarty->assign('currentSortDir', $currentSortDir);
$smarty->register_function('generateTableHeader', 'generateTableHeader');
  
$smarty->assign('title', "View Borrowers");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewBorrowers');
$smarty->assign('borrowers', $borrowers);


$smarty->display('index.tpl');

mysqli_close($link);

?>