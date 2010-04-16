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

require_once('lib/auth.lib.php');				//Session
require_once('lib/locations.lib.php'); 	//locations
require_once('lib/display.lib.php');		//formatting <option>s
require_once('lib/tooltip.lib.php');
require_once('lib/businesses.lib.php');
require_once('lib/fields.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();
if($auth < 1)
  die('You dont have permission to access this page');

// Make sure the club id is set
if (!isset($_SESSION['club']))
{
    die('No valid club selected');
}

// Club ID
$club_id = (int)$_SESSION['club'];

// SMARTY Setup
require_once('lib/smarty_inv.class.php');
$smarty = new Smarty_Inv();

//Business List
$businesses = getBusinesses($db);

//Locations
$locations = getLocationsOptions($db);
$tooltip_html = getToolTips('addPurchase');

//Categories
$category_options = get_options('categories', 'id', 'category_name', $db);

// Fields
$custom_fields = getClubCustomFields($club_id, $db);

// Default field values
$default_field_values = array();

foreach($custom_fields as &$field)
{
    if ($field->field_type_name == 'integer')
    {
        $default_field_values[$field->field_id] = getIntFieldValue($field->default_field_value_id, $db);
    }
    elseif ($field->field_type_name == 'string')
    {
        $default_field_values[$field->field_id] = getStringFieldValue($field->default_field_value_id, $db);
    }
    elseif ($field->field_type_name == 'selection')
    {
        // TODO Implement selections
        ;
    }
    else
    {
        die('Unknown custom field type');
    }
}

//BEGIN Page
	
//Assign vars
$smarty->assign('title', 'Purchase Items');
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'addPurchase');
$smarty->assign('businesses', $businesses);
$smarty->assign('selectDate', getdate(time()));
$smarty->assign('locations', $locations);
$smarty->assign('tooltip', $tooltip_html);
$smarty->assign('category_options', $category_options);
$smarty->assign('custom_fields', $custom_fields);
$smarty->assign('default_field_values', $default_field_values);

$smarty->display('index.tpl');

// Close
$db->close();

?>
