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

require_once('class/database.class.php');		//mysql
require_once('lib/auth.lib.php');				//Session
require_once('lib/locations.lib.php'); 	//locations
require_once('lib/display.lib.php');		//formatting <option>s
require_once('lib/tooltip.lib.php');

$db = new database();
	
//Authenticate
$auth = GetAuthority();
if($auth < 1)
  die('You dont have permission to access this page');

// SMARTY Setup
require_once('lib/smarty_inv.class.php');
$smarty = new Smarty_Inv();

//Business List
$businessQuery = 'SELECT business_id, company_name FROM businesses';
$businessResult = $db->query($businessQuery);
$businesses = $db->getObjectArray($businessResult);

//Locations
$locations = getLocationsOptions();
$tooltip_html = getToolTips('addPurchase');

//Categoryes
$category_options = get_options('categories', 'id', 'category_name');

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

$smarty->display('index.tpl');

$db->close();

?>
