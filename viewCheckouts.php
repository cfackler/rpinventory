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
require_once( 'lib/paginate.lib.php' );
require_once( 'lib/checkouts.lib.php' );

//Authenticate
$auth = GetAuthority();	

// SMARTY Setup

require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();

// Decide sorting method
if(isset($_GET['sort']) && ($_GET['sort'] >= 0 && $_GET['sort'] <= 4))
  $currentSortIndex = $_GET['sort'];
else
  $currentSortIndex = 3;

//Decide sorting direction
if(isset($_GET['sortdir']) && $_GET['sortdir'] == 1)
  $currentSortDir = 1;
else
  $currentSortDir = 0;
  
paginate( $smarty, 'items', $currentSortIndex, $currentSortDir, 'checkouts' );


//BEGIN Page

/* Table column headers */
$headers = array();
$headers[0] = array('label' => 'Item', 'width' => 250);
$headers[1] = array('label' => 'Starting Condition', 'width' => 175);
$headers[2] = array('label' => 'Borrower', 'width' => 100);
$headers[3] = array('label' => 'Time Taken', 'width' => 150);
$headers[4] = array('label' => 'Return Date', 'width' => 120);


//Assign vars
$smarty->assign('headers', $headers);
$smarty->assign('currentSortIndex', $currentSortIndex);
$smarty->assign('currentSortDir', $currentSortDir);
$smarty->register_function('generateTableHeader', 'generateTableHeader');

$smarty->assign('title', "View Checkouts");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewCheckouts');
$smarty->assign('filter', $view);


$smarty->display('index.tpl');




?>