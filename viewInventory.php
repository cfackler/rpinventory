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
require_once("lib/inventory.lib.php"); //inventory functions
require_once("lib/interface.lib.php"); //interface functions

$link = connect();
if($link == null)
	die("Database connection failed");
	
//Authenticate
$auth = GetAuthority();


// SMARTY Setup
require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();

/*  Determine wether or not to default sort column headers,
    Make sure no one messed with the URL by checking the $_GET vars */
if(isset($_GET['sort']) && ($_GET['sort'] <= 3 && $_GET['sort'] >= 0))
  $currentSortIndex = $_GET['sort'];
else
  $currentSortIndex = 0;
  
//Determine wether or not to default sort direction, validate $_GET
if(isset($_GET['sortdir']) && $_GET['sortdir'] == 1)
  $currentSortDir = 1;
else
  $currentSortDir = 0;
  
//Get items
$items = getInventory($currentSortIndex, $currentSortDir);


//BEGIN Page

/*  Table headers, to be sent to the generateTableHeader function from
    the template file. */
$headers = array();
$headers[0] = array('label' => 'Item', 'width' => 250);
if($auth >= 1)
{
  $headers[1] = array('label' => 'Condition', 'width' => 100);
  $headers[2] = array('label' => 'Current Value', 'width' => 150);


}
$headers[3] = array('label' => 'Location', 'width' => 150);


	
//Assign vars
$smarty->assign('currentSortIndex', $currentSortIndex);
$smarty->assign('currentSortDir', $currentSortDir);
$smarty->assign('headers', $headers);
$smarty->register_function('generateTableHeader', 'generateTableHeader');

$smarty->assign('title', "View Inventory");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewInventory');
$smarty->assign('items', $items);


$smarty->display('index.tpl');

?>