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

function getBareInventory($clubId, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'SELECT * FROM inventory WHERE club_id = ?';
    $result = $db->query($sql, $clubId);

    $items = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $items;
}

function getInventoryItem($inventory_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    // Authenticate
    $auth = GetAuthority();

    if (!isset($_SESSION['club']))
    {
        return NULL;
    }

    $club_id = $_SESSION['club'];

    $sql = 'SELECT * FROM inventory WHERE inventory_id = ? AND club_id = ?';

    $result = $db->query($sql, $inventory_id, $club_id);

    $obj = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $obj;
}

function getInventory($sortIndex = 0, $sortdir = 0, $db = null)
{
    require_once('lib/fields.lib.php');

    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    //Determine which column to sort by
    if($sortIndex == 0)
        $sortBy = 'description';
    else if($sortIndex == 1)
        $sortBy = 'description';
    else if($sortIndex == 2)
        $sortBy = 'current_condition';
    else if($sortIndex == 3)
        $sortBy = 'current_value';
    else if($sortIndex == 4)
        $sortBy = 'location';

    //Determine which direction to sort in
    if($sortdir == 0)
        $sortdir = ''; //query ascends by default
    else
        $sortdir = "DESC";

    // determine whether to limit inventory only to one club
    if (isset($_SESSION['club']))
        $clublimit = ' AND inventory.club_id = ' . $_SESSION['club'];
    else
        $clublimit = '';

    //items
    $query= "SELECT inventory.inventory_id, inventory.description, location, current_condition, current_value, clubs.club_name
        FROM inventory, locations, clubs
        WHERE inventory.club_id = clubs.club_id AND locations.location_id=inventory.location_id" . $clublimit . "
        ORDER BY ".$sortBy." ".$sortdir;

    $result = $db->query($query);

    $items = $db->getObjectArray($result);

    foreach($items as &$item)
    {
        if ($item->location == 'OnLoan')
        {
            $sql = 'SELECT loan_id FROM loans WHERE inventory_id = ? AND return_date is NULL';

            $result = $db->query($sql, $item->inventory_id);

            $loan_item = $db->getObject($result);

            $item->loan_id = $loan_item->loan_id;
            $item->checkout_id = 0;
        }
        else if ($item->location == 'Checked Out')
        {
            $sql = 'SELECT checkout_id FROM checkouts WHERE inventory_id = ? AND time_returned is NULL';

            $result = $db->query($sql, $item->inventory_id);

            $checkout_item = $db->getObject($result);

            $item->checkout_id = $checkout_item->checkout_id;
            $item->loan_id = 0;
        }
        else
        {
            $item->loan_id = 0;
            $item->checkout_id = 0;
        }

        //Get categories of item
        $sql = 'SELECT categories.category_name
            FROM inventory_category, categories
            WHERE inventory_category.inventory_id = ?
            AND categories.id=inventory_category.category_id';

        $catResult = $db->query($sql, $item->inventory_id);
        $categoryString = '';

        if (mysqli_num_rows($catResult) == 0)
        {
            $categoryString = 'Uncategorized';
        }
        else
        {
            $categories = $db->getObjectArray($catResult);

            foreach($categories as &$category)
            {
                if ($categoryString == '')
                {
                    $categoryString .= $category->category_name;
                }
                else
                {
                    $categoryString .= ', '.$category->category_name;
                }
            }
        }

        $item->category = $categoryString;

        // Get all of the custom fields for the inventory item
        $customFields = getInventoryCustomFields($_SESSION['club'], $item->inventory_id, $db);

        // Add the fields to the inventory item
        foreach($customFields as &$field)
        {
            $item->{$field->field_name} = $field->value;
        }
    }

    if ($close)
    {
        $db->close();
    }

    return $items;
}

function addInventory($itemDescription, $location, $condition, $value, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    if (!isset($_SESSION['club']))
    {
        return array();
    }

    $club_id = $_SESSION['club'];

    //Insert new inventory item
    $sql = 'INSERT INTO inventory (inventory_id, description, location_id, current_condition, current_value, club_id) VALUES (NULL, ?, ?, ?, ?, ?)';

    $db->query($sql, $itemDescription, $location, $condition, $value, $club_id);

    $id = $db->insertId();

    if ($close)
    {
        $db->close();
    }

    return $id;
}

function deleteInventory($inventory_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'DELETE FROM inventory WHERE inventory_id = ?';

    $db->query($sql, $inventory_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

function addInventoryCategory($inventory_id, $category_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    if (!isset($_SESSION['club']))
    {
        return NULL;
    }

    $club_id = $_SESSION['club'];

    $sql = 'INSERT INTO inventory_category (inventory_id, category_id, club_id) VALUES (?, ?, ?)';
    $db->query($sql, $inventory_id, $category_id, $club_id);

    $id = $db->insertId();

    if ($close)
    {
        $db->close();
    }

    return $id;
}

function removeInventoryCategory($inventory_id, $category_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    if (!isset($_SESSION['club']))
    {
        return NULL;
    }

    $club_id = $_SESSION['club'];

    $sql = 'DELETE FROM inventory_category WHERE inventory_id = ? AND category_id = ? AND club_id = ?';

    $db->query($sql, $inventory_id, $category_id, $club_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

function updateInventory($inventory_id, $description, $location_id, $condition, $value, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    if (!isset($_SESSION['club']))
    {
        return NULL;
    }

    $club_id = $_SESSION['club'];


    $sql = 'UPDATE inventory SET description = ?, location_id = ?, current_condition = ?, current_value = ? WHERE inventory_id = ?';

    $db->query($sql, $description, $location_id, $condition, $value, $inventory_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

function updateInventoryCondition($inventory_id, $condition, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'UPDATE inventory SET current_condition = ? WHERE inventory_id = ?';

    $db->query($sql, $condition, $inventory_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

function updateInventoryLocation($inventory_id, $location_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'UPDATE inventory SET location_id = ? WHERE inventory_id = ?';

    $db->query($sql, $location_id, $inventory_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

function getInventoryFromLocation($location_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'SELECT location_id FROM inventory WHERE location_id = ?'; 

    $result = $db->query($sql, $location_id);

    $records = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $records;
}

?>
