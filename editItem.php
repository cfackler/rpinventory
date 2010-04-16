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

require_once('lib/auth.lib.php');  //Session
require_once('lib/display.lib.php');
require_once('lib/locations.lib.php');
require_once('lib/inventory.lib.php');
require_once('lib/fields.lib.php');
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

//grab all ids
$idString = $_GET["ids"];

// Get the clubid
$clubId = (int)$_SESSION['club'];

//Split idString into array using ',' as delimiter
$idList = array();
$idList = explode(',', $idString);

if(count($idList) == 0)
    die("No items");

$fields = array();

//Get all items
$items = array();
foreach($idList as &$id)
{
    //item
    $item = getInventoryItem($id, $db);
    $location = getLocation($item->location_id, $db);

    $item->location = $location->location;

    // Get the fields for the inventory item
    $field = getInventoryCustomFields($clubId, $id, $db);
    if (count($field) > 0)
    {
        $fields[$field[0]->inventory_id] = $field;
    }

    $items[] = $item;
}

//print_r($fields);die();

//Locations
$locations = getLocations($db);

//Categories Options (for populating dropdown)
$category_options = get_options('categories', 'id', 'category_name', $db);

//BEGIN Page

//Assign vars
$smarty->assign('title', "Edit Item");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'editItem');
$smarty->assign('items', $items);
$smarty->assign('itemCount', count($items));
$smarty->assign('locations', $locations);
$smarty->assign('category_options', $category_options);
$smarty->assign('fields', $fields);

$smarty->display('index.tpl');

$db->close();

?>
