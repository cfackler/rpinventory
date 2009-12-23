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

require_once('lib/auth.lib.php');  //Session
require_once('lib/display.lib.php');
require_once('lib/locations.lib.php');
require_once('lib/inventory.lib.php');

//Authenticate
$auth = GetAuthority();
if($auth < 1)
    die("You dont have permission to access this page");

// SMARTY Setup
require_once('lib/smarty_inv.class.php');
$smarty = new Smarty_Inv();

//grab all ids
$idString = $_GET["ids"];

//Split idString into array using ',' as delimiter
$idList = array();
$idList = explode(',', $idString);

if(count($idList) == 0)
    die("No items");

//Get all items
$items = array();
foreach($idList as &$id)
{
    //item
    $item = getInventoryItem($id);
    $location = getLocation($item->location_id);

    $item->location = $location->location;

    $items[] = $item;
}

//Locations
$locations = getLocations();

//Categories Options (for populating dropdown)
$category_options = get_options('categories', 'id', 'category_name');

//BEGIN Page

//Assign vars
$smarty->assign('title', "Edit Item");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'editItem');
$smarty->assign('items', $items);
$smarty->assign('itemCount', count($items));
$smarty->assign('locations', $locations);
$smarty->assign('category_options', $category_options);

$smarty->display('index.tpl');

?>
