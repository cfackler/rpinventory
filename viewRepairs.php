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

// SMARTY Setup

require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();

if(isset($_GET['sort']) && isset($_GET['sortdir']))
  $sortBy = $_GET['sort']." ".$_GET['sortdir'];
else if(isset($_GET['sort']))
  $sortBy = $_GET['sort'];
else
  $sortBy = "inv_description";

//items
$query= "SELECT inventory.description AS inv_description, company_name, repairs.business_id, repair_date, repair_cost, repairs.description AS rep_description
	 FROM repairs, inventory, businesses
	 WHERE repairs.inventory_id=inventory.inventory_id AND repairs.business_id=businesses.business_id ORDER BY ".$sortBy;


$result = mysqli_query($link, $query);
$items = array();

while($item = mysqli_fetch_object($result))
{
	$items [] = $item;
}

//BEGIN Page



	
//Assign vars
if(isset($_GET['sort']))
  $smarty->assign('sort', $_GET['sort']);
if(isset($_GET['sortdir']))
  $smarty->assign('sortdir', $_GET['sortdir']);
  
$smarty->assign('title', "View Repairs");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewRepairs');
$smarty->assign('items', $items);
$smarty->assign('filter', $view);


$smarty->display('index.tpl');



mysqli_close($link);

?>