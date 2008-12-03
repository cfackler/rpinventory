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
require_once("inc/auth.php");  //Session
require_once("inc/config.php");  //configs

$link = connect();
if($link == null)
	die("Database connection failed");
	
//Authenticate
$auth = GetAuthority();
if($auth < 1)
	die("You dont have permission to access this page");

// SMARTY Setup

require_once('Smarty.class.php');

$smarty = new Smarty();
$smarty->caching = false;
$smarty->template_dir = template_dir;
$smarty->compile_dir  = compile_dir;
$smarty->config_dir   = config_dir;
$smarty->cache_dir    = cache_dir;


//grab all ids
$idString = $_GET["ids"];
$token = strtok($idString, ",");
$idList = array();
$itemDesc = array();

while ($token !== false) {
	$idList[] = (int)$token;
    $token = strtok(",");
}

//Verify all ids are valid,  get item description
foreach ($idList as $id)
{
	$result = mysqli_query($link, "select description from inventory where inventory_id = " . $id);
	if(mysqli_num_rows($result) == 0)
		die("Invalid item ID");
	
	$item = mysqli_fetch_object($result);
	$itemDesc[] = $item->description;
}


	

$itemsOut = array();

//Check Loan status
$loanedOut = false;

foreach ($idList as $id)
{
	$loanQuery = "Select description from loans, inventory where return_date is NULL and loans.inventory_id = inventory.inventory_id and loans.inventory_id = " . $id;
	$loanResult = mysqli_query($link, $loanQuery);
	if(mysqli_num_rows($loanResult) != 0)
	{
		$item = mysqli_fetch_object($loanResult);
		$itemsOut[] = $item->description;
		$loanedOut = true;
	}
	
}

//User list
$userQuery= "SELECT id, username FROM logins";
$userResult = mysqli_query($link, $userQuery);
$users = array();

while($user = mysqli_fetch_object($userResult))
{
	$users [] = $user;
}

//BEGIN Page


	
//Assign vars
$smarty->assign('title', "Loan Items");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'loanItem');
$smarty->assign('itemDesc', $itemDesc);
$smarty->assign('itemsOut', $itemsOut);
$smarty->assign('idString', $idString);
$smarty->assign('users', $users);
$smarty->assign('loanedOut', $loanedOut);
$smarty->assign('selectDate', getdate(time()));

$smarty->display('index.tpl');



mysqli_close($link);

?>
