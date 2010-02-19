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

function getClubs($db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'SELECT club_id, club_name FROM clubs';

    $result = $db->query($sql);

    $clubs = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $clubs;
}

function getClub($id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'SELECT club_id, club_name FROM clubs WHERE club_id = ?';

    $result = $db->query($sql, $id);

    $clubs = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $clubs;
}

function updateClub($id, $club_name, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'UPDATE clubs SET club_name = ? WHERE club_id = ?';

    $result = $db->query($sql, $club_name, $id);

    if ($close)
    {
        $db->close();
    }

    return $clubs;
}

function deleteClub($id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'DELETE FROM clubs WHERE club_id = ? LIMIT 1';

    $result = $db->query($sql, $id);

    if ($close)
    {
        $db->close();
    }

    return $clubs;
}

function addClub($club_name, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'INSERT INTO clubs VALUES (NULL, ?)';

    $db->query($sql, $club_name);

    $id = $db->insertId();

    if ($close)
    {
        $db->close();
    }

    return $id;
}

function alterUserClubAccess($user_id, $club_id, $access_level, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'UPDATE user_clubs SET access_level = ? WHERE user_id = ? AND club_id = ?';

    $result = $db->query($sql, $access_level, $user_id, $club_id);

    if ($close)
    {
        $db->close();
    }

    return 'success';
}

?>
