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

/* Takes two dates, formatted as YYYY-MM-DD */
function getPurchases( $startDate, $endDate )
{
    require_once('class/database.class.php');
    require_once("lib/auth.lib.php");  //Session

    // Connect
    $db = new database();

    // Authenticate
    $auth = GetAuthority();

    if (!isset($_SESSION['club']))
    {
        return array();
    }

    $club_id = $_SESSION['club'];

    // Loan History
    $query= 'SELECT purchase_date, purchases.purchase_id, company_name, description, cost, purchases.club_id FROM purchases, purchase_items, businesses, inventory WHERE purchase_items.inventory_id = inventory.inventory_id AND purchase_items.purchase_id = purchases.purchase_id AND purchases.business_id = businesses.business_id AND purchase_date >= ? AND purchase_date <= ?';

    $result = $db->query($query, $startDate, $endDate, $club_id);

    $records = $db->getObjectsArray($result);

    $db->close();

    return $records;
}

function getViewPurchases( $currentSortIndex=0, $currentSortDir=0 )
{
    require_once('class/database.class.php');
    require_once( 'lib/auth.lib.php' );

    // Connect
    $db = new database();

    // Authenticate
    $auth = GetAuthority();

    if (!isset($_SESSION['club']))
    {
        return array();
    }

    $club_id = $_SESSION['club'];

    /* Determine query argument for sorting */
    if($currentSortIndex == 0)
        $sortBy = 'purchase_id';
    else if($currentSortIndex == 1)
        $sortBy = 'company_name';
    else if($currentSortIndex == 2)
        $sortBy = 'purchase_date';
    else if($currentSortIndex == 3)
        $sortBy = 'total_price';

  /*  Determine query argument for sort direction
  Ascending is default    */
    if($currentSortDir == 1)
        $sortBy .= ' DESC';

    //users
    $query= "SELECT purchases.purchase_id, purchases.business_id, purchases.purchase_date, company_name, total_price, purchases.club_id FROM purchases, businesses WHERE businesses.business_id=purchases.business_id ORDER BY ".$sortBy;

    $result = $db->query($query, $club_id);
    $purchases = $db->getObjectArray($result);
    $items = array();

    foreach($purchases as &$purchase)
    {
        $itemQuery = 'SELECT purchase_id, description from inventory, purchase_items WHERE inventory.inventory_id = purchase_items.inventory_id and purchase_items.purchase_id = ?';

        $itemResult = $db->query($itemQuery, $purchase->purchase_id);

        $string = '';

        $items = $db->getObjectArray($itemResult);

        foreach($items as &$item)
        {
            if (strlen($string) != 0)
            {
                $string .= ', ';
            }

            $string .= $item->description;
        }

        $purchase->items = $string;
    }

    $db->close();

    return $purchases;  
}

?>
