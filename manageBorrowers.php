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


require_once("lib/connect.lib.php");  //mysql
require_once("lib/auth.lib.php");  //Session
require_once("lib/interface.lib.php"); //interface functions
require_once( 'lib/paginate.lib.php' );
require_once( 'lib/borrowers.lib.php' );

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();	
if($auth != 2)
	die("You dont have permission to access this page");

// SMARTY Setup

require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();


// Decide sorting method
if(isset($_GET['sort']) && ($_GET['sort'] >= 0 && $_GET['sort'] <= 2))
  $currentSortIndex = $_GET['sort'];
else
  $currentSortIndex = 0;

//Decide sorting direction
if(isset($_GET['sortdir']) && $_GET['sortdir'] == 1)
  $currentSortDir = 1;
else
  $currentSortDir = 0;

paginate( $smarty, 'borrowers', $currentSortIndex, $currentSortDir, 'manageBorrowers' );

/* Table column headers */
$headers = array();
$headers[0] = array('label' => 'Name', 'width' => 150);
$headers[1] = array('label' => 'RIN', 'width' => 100);
$headers[2] = array('label' => 'Email', 'width' => 150);

//Assign vars
$smarty->assign('headers', $headers);
$smarty->assign('currentSortIndex', $currentSortIndex);
$smarty->assign('currentSortDir', $currentSortDir);
$smarty->register_function('generateTableHeader', 'generateTableHeader');

$smarty->assign('title', "Manage Borrowers");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'manageBorrowers');


$smarty->display('index.tpl');




?>
