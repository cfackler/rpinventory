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

/* Returns the id of the given borrower */
function getAddressFromBorrower($borrower_id, $db = null)
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
        return 0;
    }

    $club_id = $_SESSION['club'];

    $sql = 'SELECT *  FROM addresses, borrowers WHERE addresses.address_id = borrowers.address_id and borrowers.borrower_id = ? LIMIT 1';

    $result = $db->query($sql, $borrower_id);

    if (mysqli_num_rows($result) == 0)
    {
        return NULL;
    }

    $obj = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $obj;
}

/* Returns the address with the given id */
function getAddress($id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

    	// Database
        $db = new database();

        $close = true;
    }

	// Sanitize
	$id = (int)$id;
	if($id == 0)
		die('Invalid ID');

	$sql = 'SELECT * FROM addresses WHERE address_id = ?';

    $result = $db->query($sql, $id);

	$address = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

	return $address;
}

function addAddress($address, $address2, $city, $state, $zipcode, $phone, $db = null)
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
        return 0;
    }

    $club_id = $_SESSION['club'];

    $sql = 'INSERT INTO addresses (address_id, address, address2, city, state, zipcode, phone, club_id) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)';

    $db->query($sql, $address, $address2, $city, $state, $zipcode, $phone, $club_id);

    $id = $db->insertId();

    if ($close)
    {
        $db->close();
    }

    return $id;
}

function updateAddress($address_id, $address, $address2, $city, $state, $zipcode, $phone, $db = null)
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
        return 0;
    }

    $club_id = $_SESSION['club'];

    $sql = 'UPDATE addresses SET address = ?, address2 = ?, city = ?, state = ?, zipcode = ?, phone = ? WHERE address_id = ?';

    $db->query($sql, $address, $address2, $city, $state, $zipcode, $phone, $address_id);

    if ($close)
    {
        $db->close();
    }
}

function deleteAddress($address_id, $db = null)
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
        return 0;
    }

    $club_id = $_SESSION['club'];

    $sql = 'DELETE FROM addresses WHERE address_id = ? AND club_id = ?';

    $db->query($sql, $addres_id, $club_id);

    if ($close)
    {
        $db->close();
    }
}

?>
