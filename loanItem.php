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

require_once('class/database.class.php');  //mysql
require_once("lib/auth.lib.php");  //Session
require_once('lib/locations.lib.php');
require_once('lib/tooltip.lib.php');

//Authenticate
$auth = GetAuthority();
if($auth < 1)
  die("You dont have permission to access this page");

$db = new database();

// SMARTY Setup
require_once('lib/smarty_inv.class.php');
$smarty = new Smarty_Inv();

//grab all ids
$idString = $_GET["ids"];
$token = strtok($idString, ",");
$idList = array();
$itemDesc = array();

while ($token !== false) 
{
    $idList[] = (int)$token;
    $token = strtok(",");
}

//Verify all ids are valid,  get item description
foreach ($idList as $id) 
{
    $result = $db->query('SELECT description FROM inventory WHERE inventory_id = ?', $id);

    if(mysqli_num_rows($result) == 0)
    {
        die("Invalid item ID");
    }
  
    $item = $db->getObject($result);
    $itemDesc[] = $item->description;
}

$itemsOut = array();

//Check Loan status
$loanedOut = false;

foreach ($idList as $id)
{
    // Make sure the item isn't loaned out
    $loanQuery = 'SELECT description FROM loans, inventory WHERE return_date is NULL and loans.inventory_id = inventory.inventory_id and loans.inventory_id = ?';

    $loanResult = $db->query($loanQuery, $id);

    if(mysqli_num_rows($loanResult) != 0)
    {
        $item = $db->getObject($loanResult);
        $itemsOut[] = $item->description;
        $loanedOut = true;
    }

    // Make sure the item isn't checked out
    $checkoutQuery = 'SELECT description from checkouts, inventory WHERE time_returned is NULL and checkouts.inventory_id = inventory.inventory_id and checkouts.inventory_id = ?';
    
    $checkoutResult = $db->query($checkoutQuery, $id);

    if (mysqli_num_rows($checkoutResult) != 0 )
    {
        $item = $db->getObject($checkoutResult);
        $itemsOut[] = $item->description;
        $loanedOut = true;
    }
}

//Locations
$locations = getLocationsOptions();

//Tooltips
$tooltips_html = getToolTips('loanItem');

//BEGIN Page
	
//Assign vars
$smarty->assign('title', "Loan Items");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'loanItem');
$smarty->assign('itemDesc', $itemDesc);
$smarty->assign('itemsOut', $itemsOut);
$smarty->assign('idString', $idString);
$smarty->assign('loanedOut', $loanedOut);
$smarty->assign('selectDate', getdate(time()));
$smarty->assign('locations', $locations);
$smarty->assign('toolTipHelp', $tooltips_html);

$smarty->display('index.tpl');

$db->close();

?>
