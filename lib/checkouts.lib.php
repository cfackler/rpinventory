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

function getCheckout($checkoutId, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'SELECT checkouts.*, inventory.description, borrowers.name, locations.location, inventory.current_condition FROM checkouts, inventory, borrowers, locations WHERE checkouts.checkout_id = ? AND checkouts.inventory_id = inventory.inventory_id AND checkouts.borrower_id = borrowers.borrower_id AND locations.location_id = checkouts.original_location_id';

    $result = $db->query($sql, $checkoutId);

    $checkout = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $checkout;
}

function getCheckouts($startDate, $endDate, $db = null)
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

    // Checkout History
    $query= 'SELECT time_taken, time_returned, event_name, starting_condition, ending_condition, inventory.description, username, original_location_id, checkouts.club_id FROM checkouts, inventory, logins WHERE logins.id = checkouts.borrower_id AND checkouts.inventory_id = inventory.inventory_id AND time_taken >= ? AND (time_returned <= ? OR time_returned IS NULL) AND checkouts.club_id = ?';


    $result = $db->query($query, $startDate, $endDate, $club_id);

    $records = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $records;
}

function getViewCheckouts($currentSortIndex=0, $currentSortDir=0, $db = null)
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

    //items
    $query=   'SELECT checkout_id, checkouts.inventory_id, checkouts.club_id, name, borrowers.borrower_id, time_taken, time_returned, starting_condition, description, original_location_id FROM borrowers, checkouts, inventory WHERE checkouts.borrower_id = borrowers.borrower_id and inventory.inventory_id = checkouts.inventory_id AND checkouts.club_id = ?';

    //Filter
    if(!isset($_GET['view']))
        $view = "all";
    else
        $view = $_GET['view'];

    if($view == "outstanding")
    {
        $query .= ' and time_returned IS NULL';
    }
    else if($view == "returned")
    {
        $query .= ' and time_returned IS NOT NULL';
    }

    $query .= ' ORDER BY';

    /* Determine what column to sort by for SQL query */
    if($currentSortIndex == 0)
        $query .= ' description';
    else if($currentSortIndex == 1)
        $query .= ' starting_condition';
    else if($currentSortIndex == 2)
        $query .= ' username';
    else if($currentSortIndex == 3)
        $query .= ' time_taken';
    else if($currentSortIndex == 4)
        $query .= ' time_returned';

  /*  Determine query argument for sort direction
  Ascending is default    */
    if($currentSortDir == 1)
        $query .= ' DESC';

    $result = $db->query($query, $club_id);

    $items = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $items;
}

function isCheckedOut($inventory_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'SELECT description from checkouts, inventory WHERE time_returned is NULL and checkouts.inventory_id = inventory.inventory_id and checkouts.inventory_id = ?';

    $result = $db->query($sql, $inventory_id);

    $obj = NULL;

    if (mysqli_num_rows($result) != 0)
    {
        $obj = $db->getObject($result);
    }

    if ($close)
    {
        $db->close();
    }

    return $obj;
}

function getBorrowerActiveCheckouts($borrower_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'SELECT * from checkouts WHERE time_returned is null AND borrower_id = ?';

    $result = $db->query($sql, $borrower_id); 

    $records = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $records;
}

function getActiveCheckoutsByOriginalLocation($location_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'SELECT original_location_id FROM checkouts WHERE time_returned is null AND original_location_id = ?';

    $result = $db->query($sql, $borrower_id);

    $records = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $records;
}

function addCheckout($inventory_id, $borrower_id, $time_taken, $event_location, $event_name, $starting_condition, $original_location_id, $db = null)
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

    $sql = 'INSERT INTO checkouts (checkout_id, inventory_id, borrower_id, time_taken, time_returned, event_name, event_location, starting_condition, ending_condition, original_location_id, club_id) VALUES (NULL, ?, ?, ?, NULL, ?, ?, ?, NULL, ?, ?)';

    $db->query($sql, $inventory_id, $borrower_id, $time_taken, $event_location, $event_name, $starting_condition, $original_location_id, $club_id);

    $id = $db->insertId();

    if ($close)
    {
        $db->close();
    }

    return $id;
}

function updateCheckout($checkout_id, $time_returned, $ending_condition, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'Update checkouts set time_returned = ?, ending_condition = ? WHERE checkout_id = ?';

    $db->query($sql, $time_returned, $ending_condition, $checkout_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

?>
