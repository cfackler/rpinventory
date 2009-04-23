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
require_once("lib/interface.lib.php"); //interface functions

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
 * SQL stuff
 **/
 
 /* Determine query argument for sorting */
if($currentSortIndex == 0)
  $sortBy = 'location';
else if($currentSortIndex == 1)
  $sortBy = 'description';

/*  Determine query argument for sort direction
    Ascending is default    */
if($currentSortDir == 1)
  $sortBy .= ' DESC';

//users
$locQuery= "SELECT * from locations ORDER BY ".$sortBy;
$locResult = mysqli_query($link, $locQuery);
$locations = array();

while($loc = mysqli_fetch_object($locResult))
{
	$locations [] = $loc;
}
mysqli_close($link);






/* Table column headers */
$headers = array();
$headers[0] = array('label' => 'Location', 'width' => 200);
$headers[1] = array('label' => 'Description', 'width' => 300);



//Assign vars
$smarty->assign('headers', $headers);
$smarty->assign('currentSortIndex', $currentSortIndex);
$smarty->assign('currentSortDir', $currentSortDir);
$smarty->register_function('generateTableHeader', 'generateTableHeader');
  
$smarty->assign('title', "Manage Locations");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'manageLocations');
$smarty->assign('locations', $locations);


$smarty->display('index.tpl');




?>