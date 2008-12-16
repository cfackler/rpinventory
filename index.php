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

// Run setup if config.php does not exist
if (!file_exists('inc/config.php'))
  header('Location: setup/setup.php');
  
require_once("inc/auth.php");  //Session
require_once("inc/config.php");  //configs

//Authenticate
$auth = GetAuthority();


// SMARTY Setup
require_once('inc/setup.php');

$smarty = new Smarty_Inv();

//BEGIN Page

	
//Assign vars
$smarty->assign('title', "RPInventory");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'main');


$smarty->display('index.tpl');


?>
