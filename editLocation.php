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

//Authenticate
$auth = GetAuthority();
if($auth < 1)
  die("You dont have permission to access this page");

$link = connect();
if($link == null)
  die("Database connection failed");
	
// SMARTY Setup
require_once('lib/smarty_inv.class.php');
$smarty = new Smarty_Inv();

//id
$id = (int)$_GET["id"];
if($id == 0)
  die("Invalid ID");

//location
$query= "SELECT *  FROM locations WHERE location_id = " . $id;
$result = mysqli_query($link, $query);
$location = mysqli_fetch_object($result);
	
//Assign vars
$smarty->assign('title', "Edit Location");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'editLocation');
$smarty->assign('location', $location);

$smarty->display('index.tpl');

mysqli_close($link);

?>
