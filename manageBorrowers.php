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


require_once("lib/auth.lib.php");  //Session
require_once( 'lib/borrowers.lib.php' );
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

$borrowers = getViewBorrowers($db);

//Assign vars
$smarty->assign('borrowers', $borrowers);
if (count($borrowers) == 0)
{
    $smarty->assign('emptyTable', TRUE);
}

$smarty->assign('title', "Manage Borrowers");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'manageBorrowers');


$smarty->display('index.tpl');

$db->close();

?>
