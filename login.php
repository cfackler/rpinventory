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

$link = connect();
if($link == null)
	die("Database connection failed");
	

// SMARTY Setup

require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();

$loginStatus = "none";
if(isset($_GET['login']) && $_GET['login'] == "fail")
{
	$loginStatus = "fail";
}

// Clubs list
$clubsResult = mysqli_query($link, 'SELECT club_id, club_name FROM clubs');
$clubs = array();

while ($club = mysqli_fetch_object($clubsResult))
  $clubs [] = $club;

//Assign vars
$smarty->assign('title', "Login");
$smarty->assign('loginStatus', $loginStatus);
$smarty->assign('page_tpl', 'login');
$smarty->assign('clubs', $clubs);

$smarty->display('index.tpl');



mysqli_close($link);

?>