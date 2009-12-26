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
require_once( 'lib/loans.lib.php' ); 
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	

// SMARTY Setup

require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();

// Check to see if we want to see just one item
$viewLoanId = 0;
if( isset( $_GET['loanId'] ) ) {
	$viewLoanId = (int)$_GET['loanId'];
}


//paginate( $smarty, 'items', $currentSortIndex, $currentSortDir, 'loans' );
$items = getViewLoans($db);

if( $viewLoanId > 0 ) {
	$loanObj = getLoan($viewLoanId, $db);
}

//BEGIN Page



//Assign vars
$smarty->assign('viewLoanId', $viewLoanId);
if(isset($loanObj))
	$smarty->assign('loanObj', $loanObj);
	
$smarty->assign('items', $items);
if (count($items) == 0)
{
    $smarty->assign('emptyTable', TRUE);
}

$smarty->assign('title', "View Loans");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewLoans');
if(isset($_GET['view']))
	$smarty->assign('filter', $_GET['view']);
else
  $smarty->assign('filter', 'all');

$smarty->display('index.tpl');

$db->close();

?>
