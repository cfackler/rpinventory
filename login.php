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
require_once('lib/clubs.lib.php');

// SMARTY Setup

require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();

$loginStatus = "none";
if(isset($_GET['login']) && $_GET['login'] == "fail")
{
	$loginStatus = "fail";
}

// Clubs list
$clubs = getClubs();

//Assign vars
$smarty->assign('title', "Login");
$smarty->assign('loginStatus', $loginStatus);
$smarty->assign('page_tpl', 'login');
$smarty->assign('clubs', $clubs);

$smarty->display('index.tpl');

?>
