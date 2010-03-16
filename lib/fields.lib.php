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
function addCustomField($fieldName, $fieldTypeId, $defaultValue, $defaultValueId, $clubId, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'INSERT INTO fields (field_id, club_id, field_name, field_type_id, default_field_value_id) VALUES (NULL, ?, ?, ?, ?)';
    $db->query($sql, $clubId, $fieldName, $fieldTypeId, $defaultValueId);

    $id = $db->insertId();

    // Add the new custom fields
    updateInventoryCustomFields($id, $clubId, $defaultValue, $db);

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

    // TODO Change this so not to create duplicate field-types
    // There's no reason why multiple fields can't use the same field_type_id, right?
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

function deleteCustomField($fieldId, $clubId, $db)
{
    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    // Get the field
    $field = getField($fieldId, $db);

    // Security
    $clubId = (int)$clubId;

    // Determine what to do for the type of field 
    switch ($field->field_type_name)
    {
        case 'integer':
            // Get all of the field-value ids
            $sql = 'SELECT * FROM club_fields_'.$clubId.' WHERE field_id = ?';

            $result = $db->query($sql, $fieldId);
            $items = $db->getObjectArray($result);

            // Delete each of the field_values
            $sql = 'DELETE FROM field_value_int WHERE field_value_int_id = ? LIMIT 1';

            foreach($items as &$item)
            {
                $db->query($sql, $item->field_value_id);
            }

            break;
        case 'string':
            break;
        case 'selection':
            break;
        default:
            die('Unsupported value');
    }

    // Delete the club_field entries
    $sql = 'DELETE FROM club_fields_'.$clubId.' WHERE field_id = ?';
    $db->query($sql, $field->field_id);

    // Delete the custom field entry
    $sql = 'DELETE FROM fields WHERE field_id = ?';
    $db->query($sql, $field->field_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

function updateInventoryCustomFields($fieldId, $clubId, $value, $db=null)
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
    $sql = 'INSERT INTO club_fields_'.$clubId.' (inventory_id, field_id, field_value_id) VALUES (?, ?, ?)';
    $fieldValueId;
    $field = getField($fieldId);

    foreach($items as &$item)
    {
        // Default int value
        if ($field->field_type_name == 'integer')
        {
            $fieldValueId = addIntFieldValue($value);
        }
        elseif ($field->field_type_name == 'string')
        {
            $fieldValueId = addStringFieldValue($value);
        }
        elseif ($field->field_type_name == 'selection')
        {
            $fieldValueId = addSelectionFieldValue($value);
        }
        else
        {
            die('Invalid field type name');
        }

        $db->query($sql, $item->inventory_id, $fieldId, $fieldValueId);
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

    // Just in case
    $clubId = (int)$clubId;

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

function getIntFieldValue($id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }    

    $sql = 'SELECT * FROM field_value_int WHERE field_value_int_id = ?';
    $result = $db->query($sql, $id);

    $item = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $item->value;
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

function getStringFieldValue($id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }    

    $sql = 'SELECT * FROM field_value_string WHERE field_value_string_id = ?';
    $result = $db->query($sql, $id);

    $item = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $item->value;
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

function getSelectionFieldValue($id, $db = null)
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

    return $item;
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

function getClubCustomFields($clubId, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }    

    $sql = 'SELECT * FROM fields, field_types WHERE fields.club_id = ? AND fields.field_type_id = field_types.field_type_id';
    $result = $db->query($sql, $clubId);

    $items = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $items;
}

function getAllInventoryCustomFields($clubId, $db = null)
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

    $sql = 'SELECT field_type_name, field_value_id, inventory_id FROM fields, field_types, club_fields_'.$clubId.' WHERE fields.club_id = ? AND fields.field_type_id = field_type.field_type_id AND club_fields_'.$clubId.'.field_id = fields.field_id';

    $result = $db->query($sql);

    $items = $db->getObjectArray($result);

    foreach($items as &$item)
    {
        if ($item->field_type_name == 'integer')
        {
            $item->value = getIntFieldValue($item->field_value_id);
        }
        elseif ($item->field_type_name == 'string')
        {
            $item->value = getStringFieldValue($item->field_value_id);
        }
        elseif ($item->field_type_name == 'selection')
        {
            //TODO
        }
    }

    if ($close)
    {
        $db->close();
    }

    return $items;
}

function getInventoryCustomFields($clubId, $inventoryId, $db = null)
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

    $sql = 'SELECT field_name, field_type_name, field_value_id, fields.field_id, inventory_id FROM fields, field_types, club_fields_'.$clubId.' WHERE fields.club_id = ? AND fields.field_type_id = field_types.field_type_id AND club_fields_'.$clubId.'.field_id = fields.field_id AND inventory_id = ?';

    $result = $db->query($sql, $clubId, $inventoryId);

    $items = $db->getObjectArray($result);

    foreach($items as &$item)
    {
        if ($item->field_type_name == 'integer')
        {
            $item->value = getIntFieldValue($item->field_value_id);
        }
        elseif ($item->field_type_name == 'string')
        {
            $item->value = getStringFieldValue($item->field_value_id);
        }
        elseif ($item->field_type_name == 'selection')
        {
            //TODO
        }
    }

    if ($close)
    {
        $db->close();
    }

    return $items;
}
?>
