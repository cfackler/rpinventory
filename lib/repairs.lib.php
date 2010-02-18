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

/* Takes two dates, formatted as YYYY-MM-DD */
function getRepairs($startDate, $endDate, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    if (!isset($_SESSION['club']))
    {
        return array();
    }

    $club_id = $_SESSION['club'];

    // Loan History
    $query= 'SELECT repairs.description AS repair_description, repair_cost, repair_date, company_name, inventory.description AS inventory_description repairs.club_id FROM repairs, inventory, businesses WHERE repairs.inventory_id = inventory.inventory_id AND repairs.business_id = businesses.business_id AND repair_date >= ? AND repair_date <= ? AND repairs.club_id = ?';

    $result = $db->query($query, $startDate, $endDate);

    $records = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $records;
}

function getViewRepairs($currentSortIndex=0, $currentSortDir=0, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    /* Determine query argument for sorting */
    if($currentSortIndex == 0)
        $sortBy = 'inv_description';
    else if($currentSortIndex == 1)
        $sortBy = 'company_name';
    else if($currentSortIndex == 2)
        $sortBy = 'repair_date';
    else if($currentSortIndex == 3)
        $sortBy = 'repair_cost';
    else if($currentSortIndex == 4)
        $sortBy = 'rep_description';

  /*  Determine query argument for sort direction
  Ascending is default    */
    if($currentSortDir == 1)
        $sortBy .= ' DESC';

    if (!isset($_SESSION['club']))
    {
        return array();
    }

    $club_id = $_SESSION['club'];

    //items
    $query= "SELECT inventory.description AS inv_description, company_name, repairs.business_id, repair_date, repair_cost, repairs.description AS rep_description, repairs.club_id
        FROM repairs, inventory, businesses
        WHERE repairs.inventory_id=inventory.inventory_id AND repairs.business_id=businesses.business_id AND repairs.club_id = ? ORDER BY ".$sortBy;

    $result = $db->query($query, $club_id);

    $items = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $items;
}

function addRepair($inventory_id, $business_id, $date, $cost, $description, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    if (!isset($_SESSION['club']))
    {
        return array();
    }

    $club_id = $_SESSION['club'];

    $sql = 'INSERT INTO repairs (repair_id, inventory_id, business_id, repair_date, repair_cost, description, club_id) VALUES (NULL, ?, ?, ?, ?, ?, ?)';

    $db->query($sql, $inventory_id, $business_id, $date, $cost, $description, $club_id);

    $id = $db->insertId();

    if ($close)
    {
        $db->close();
    }

    return $id;
}

?>
