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
require_once("lib/interface.lib.php"); //interface

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();	

// SMARTY Setup

require_once('lib/smarty_inv.class.php');

$smarty = new Smarty_Inv();

// Decide sorting method
if(isset($_GET['sort']) && ($_GET['sort'] >= 0 && $_GET['sort'] <= 4))
  $currentSortIndex = $_GET['sort'];
else
  $currentSortIndex = 3; //default sorting column is Loan Date (3)

//Decide sorting direction
if(isset($_GET['sortdir']) && $_GET['sortdir'] == 1)
  $currentSortDir = 1;
else
  $currentSortDir = 0;
  


/**
 *  Move query to function eventually
 **/

//items
$query=   'SELECT loan_id, loans.inventory_id, username, borrower_id, issue_date, return_date, starting_condition, username, description
          FROM logins, loans, inventory 
          WHERE loans.borrower_id = logins.id and inventory.inventory_id = loans.inventory_id ';


//Filter
if(!isset($_GET['view']))
	$view = "all";
else
	$view = $_GET['view'];

if($view == "outstanding")
{
	$query .= 'and return_date IS NULL ';
}
else if($view == "returned")
{
	$query .= 'and return_date IS NOT NULL ';
}

$query .= 'ORDER BY ';

 /* Determine query argument for sorting */
if($currentSortIndex == 0)
  $query .= 'description';
else if($currentSortIndex == 1)
  $query .= 'starting_condition';
else if($currentSortIndex == 2)
  $query .= 'username';
else if($currentSortIndex == 3)
  $query .= 'issue_date';
else if($currentSortIndex == 4)
  $query .= 'return_date';

/* Determine sort direction */
if($currentSortDir == 1)
  $query .= ' DESC';

$result = mysqli_query($link, $query) or die(mysqli_error($link));
    

$items = array();

while($item = mysqli_fetch_object($result))
{
	$items [] = $item;
}
mysqli_close($link);





//BEGIN Page
/* table column headers */
$headers = array();
$headers[0] = array('label' => 'Item',                'width' => 250);
$headers[1] = array('label' => 'Starting Condition',  'width' => 175);
$headers[2] = array('label' => 'Borrower',            'width' => 100);
$headers[3] = array('label' => 'Loan Date',           'width' => 100);
$headers[4] = array('label' => 'Return Date',         'width' => 120);



//Assign vars
$smarty->assign('headers', $headers);
$smarty->assign('currentSortIndex', $currentSortIndex);
$smarty->assign('currentSortDir', $currentSortDir);
$smarty->register_function('generateTableHeader', 'generateTableHeader');

$smarty->assign('title', "View Loans");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewLoans');
$smarty->assign('items', $items);
$smarty->assign('filter', $view);


$smarty->display('index.tpl');

?>