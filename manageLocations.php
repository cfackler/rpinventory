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

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
	die("You dont have permission to access this page");

// SMARTY Setup

require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();

if(isset($_GET['sort']) && isset($_GET['sortdir']))
  $sortBy = $_GET['sort']." ".$_GET['sortdir'];
else if(isset($_GET['sort']))
  $sortBy = $_GET['sort']." ".$_GET['sortdir'];
else
  $sortBy = 'location';

//users
$locQuery= "SELECT * from locations ORDER BY ".$sortBy;
$locResult = mysqli_query($link, $locQuery);
$locations = array();

while($loc = mysqli_fetch_object($locResult))
{
	$locations [] = $loc;
}

	
//Assign vars
if(isset($_GET['sort']))
  $smarty->assign('sort', $_GET['sort']);
if(isset($_GET['sortdir']))
  $smarty->assign('sortdir', $_GET['sortdir']);
  
$smarty->assign('title', "Manage Locations");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'manageLocations');
$smarty->assign('locations', $locations);


$smarty->display('index.tpl');



mysqli_close($link);

?>