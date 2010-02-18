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
require_once('lib/tooltip.lib.php');
require_once('lib/inventory.lib.php');
require_once('lib/loans.lib.php');
require_once('lib/checkouts.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();
if($auth < 1)
    die("You dont have permission to access this page");

// SMARTY Setup
require_once('lib/smarty_inv.class.php');
$smarty = new Smarty_Inv();

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
    $item = getInventoryItem($id, $db);
    $itemDesc[] = $item->description;
}

$itemsOut = array();

//Check Loan status
$loanedOut = false;

foreach ($idList as $id)
{
    // Make sure the item isn't loaned out
    $result = isLoanedOut($id, $db);

    if (!is_null($result))
    {
        $itemsOut[] = $result->description;
        $loanedOut = true;
    }


    // Make sure the item isn't checked out
    $result = isCheckedOut($id, $db);

    if (!is_null($result))
    {
        $itemsOut[] = $result->description;
        $loanedOut = true;
    }
}

// Tooltips
$tooltips_html = getToolTips('checkoutItem');

//BEGIN Page

//Assign vars
$smarty->assign('title', "Loan Items");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'checkoutItem');
$smarty->assign('itemDesc', $itemDesc);
$smarty->assign('itemsOut', $itemsOut);
$smarty->assign('idString', $idString);
$smarty->assign('loanedOut', $loanedOut);
$smarty->assign('selectDate', getdate(time()));
$smarty->assign('dateTime', date('Y-m-d H:i:s') );
$smarty->assign('toolTipHelp', $tooltips_html);
$smarty->assign('club_id', $_SESSION['club']);

$smarty->display('index.tpl');

$db->close();

?>
