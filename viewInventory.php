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

require_once("lib/auth.lib.php");  //Session
require_once("lib/inventory.lib.php"); //inventory functions
require_once( 'lib/display.lib.php' ); // categories options

//Authenticate
$auth = GetAuthority();

// SMARTY Setup
require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();

/* get categories */
$categories = get_options('categories', 'id', 'category_name');

/* get inventory items */
$items = getInventory();

//Assign vars
$smarty->assign('items', $items);
if (count($items) == 0)
{
    $smarty->assign('emptyTable', TRUE);
}

$smarty->assign('categories', $categories);

$smarty->assign('title', "View Inventory");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewInventory');

$smarty->display('index.tpl');

?>
