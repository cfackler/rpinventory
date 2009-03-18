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
require_once("lib/auth.lib.php");  //Session

$link = connect();
if($link == null)
  die("Database connection failed");
	
//Authenticate
$auth = GetAuthority();

// SMARTY Setup
require_once('inc/setup.php');
$smarty = new Smarty_Inv();

//items
$query= "SELECT location_id, location  FROM locations";
$result = mysqli_query($link, $query);
$locations = array();

while($loc = mysqli_fetch_object($result))
  $locations [] = $loc;

//BEGIN Page
	
//Assign vars
$smarty->assign('title', "Add Inventory");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'addInventory');
$smarty->assign('locations', $locations);

$smarty->display('index.tpl');

mysqli_close($link);

?>
