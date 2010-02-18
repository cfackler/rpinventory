<?php

/*

    Copyright (C) 2010, All Rights Reserved.

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
require_once( 'lib/businesses.lib.php' );
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	


// SMARTY Setup

require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();

  
//paginate( $smarty, 'businesses', $currentSortIndex, $currentSortDir, 'businesses' );
$businesses = getViewBusinesses($db);

	
//Assign vars
$smarty->assign('headers', $headers);
  
$smarty->assign('title', "Manage Businesses");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewBusinesses');
$smarty->assign('businesses', $businesses);
if (count($businesses) == 0)
{
    $smarty->assign('emptyTable', TRUE);
}

$smarty->display('index.tpl');

$db->close();

?>
