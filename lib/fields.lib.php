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

function getField($fieldId, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'SELECT * FROM fields, field_types WHERE field_id = ? AND fields.field_type_id = field_types.field_type_id';
    $result = $db->query($sql, $fieldId);

    $item = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $item;
}

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
    $db->query($sql, $clubId, $fieldName, $fieldTypeId);

    $id = $db->insertId();

    // Add the new custom fields
    updateInventoryCustomFields($id, $clubId);

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

function updateInventoryCustomFields($fieldId, $clubId)
{
    require_once('lib/inventory.lib.php');

    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $clubId = (int)$clubId;

    $items = getBareInventory($clubId, $db);
    $sql = 'INSERT INTO club_field_'.$clubID.' (inventory_id, field_id, field_value_id) VALUES (?, ?, ?)';
    $fieldValueId;
    $field = getField($fieldId);

    foreach($items as &$item)
    {
        // Default int value
        if ($field->field_type_name == 'integer')
        {
            $fieldValueId = addIntFieldValue(0);
        }
        elseif ($field->field_type_name == 'string')
        {
            $fieldValueId = addStringFieldValue('');
        }
        elseif ($field->field_type_name == 'selection')
        {
            $fieldValueId = addSelectionFieldValue(null);
        }
        else
        {
            die('Invalid field type name');
        }

        $db->query($sql, $inventory_id, $field_id, $fieldValueId);
    }
    
    if ($close)
    {
        $db->close();
    }

    return;
}

/* Create the table to store the custom fields for a given club */
function createClubCustomFieldTable($clubId, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = <<<END
CREATE TABLE club_fields_$clubId (
    inventory_id int(5) NOT NULL,
    field_id int(5) NOT NULL,
    field_value_id int(5) NOT NULL,
    PRIMARY KEY (inventory_id, field_id)
) type=MyISAM;
END;

    $db->query($sql);
    
    if ($close)
    {
        $db->close();
    }

    return;
}

function addIntFieldValue($value, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }    

    $sql = 'INSERT INTO field_value_int (field_value_int_id, value) VALUES (NULL, ?)';
    $db->query($sql, $value);

    $id = $db->insertId();

    if ($close)
    {
        $db->close();
    }

    return $id;
}

function addStringFieldValue($value, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }    

    $sql = 'INSERT INTO field_value_string (field_value_string_id, value) VALUES (NULL, ?)';
    $db->query($sql, $value);

    $id = $db->insertId();

    if ($close)
    {
        $db->close();
    }

    return $id;
}

function addSelectionFieldValue($value, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }    

    // TODO

    if ($close)
    {
        $db->close();
    }

    return $id;
}


?>
