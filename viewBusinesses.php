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


// SMARTY Setup

require_once('Smarty.class.php');

$smarty = new Smarty();
$smarty->caching = false;
$smarty->template_dir = template_dir;
$smarty->compile_dir  = compile_dir;
$smarty->config_dir   = config_dir;
$smarty->cache_dir    = cache_dir;



//users
$query= "SELECT company_name, address, address2, city, state, zipcode, phone, fax, email, website
	     FROM businesses, addresses
	     WHERE businesses.address_id=addresses.address_id";
$result = mysqli_query($link, $query);
$businesses = array();

while($business = mysqli_fetch_object($result))
{
	$businesses [] = $business;
}

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "Manage Businesses");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'manageBusinesses');
$smarty->assign('businesses', $businesses);


$smarty->display('index.tpl');



mysqli_close($link);

?>