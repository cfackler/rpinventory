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

/* Inserts the custom field into the 'fields' table and updates all inventory items */
function addCustomField($fieldName, $fieldTypeId, $clubId, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'INSERT INTO fields (field_id, club_id, field_name, fieldtype_id) VALUES (NULL, ?, ?, ?)';
    $db->query($sql, $clubId $fieldName, $fieldTypeId);

    $id = $db->insertId();

    // Add the new custom fields
    updateInventoryCustomFields($id);

    if ($close)
    {
        $db->close();
    }

    return $id;
}

/* Records the field type (int, string, selection, etc) */
function addFieldType($fieldTypeName, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'INSERT INTO field_types (field_type_id, field_type_name) VALUES (NULL, ?)';
    $db->query($sql, $fieldTypeName);

    $id = $db->insertId();

    if ($close)
    {
        $db->close();
    }

    return $id;
}

/* Stores an array of options to be used for a selection custom field */
function addSelectValues($fieldTypeId, $optionArray, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'INSERT INTO field_select_value (field_type_id, field_choice) VALUES (?, ?)';
    foreach($optionArray as &$option)
    {
        $db->query($sql, $fieldTypeId, $option);
    }

    if ($close)
    {
        $db->close();
    }

    return;
}



?>
