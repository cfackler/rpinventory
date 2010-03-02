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

require_once('lib/auth.lib.php');  // Session
require_once('class/database.class.php');
require_once('lib/fields.lib.php');

// Connect
$db = new database();

// Authenticate
$auth = GetAuthority();
if ($auth < 2)
{
    die('Insufficient credentials!');
}

// Field type
$fieldType = $_POST['fieldType'];

if ($fieldType != 'integer' && $fieldType != 'string' && $fieldType != 'selection')
{
    die('Invalid field type!');
}

// Check to see if a default value was given
if (!isset($_POST['defaultValue']))
{
    die('No default value given!');
}

// Default value
$defaultValue = $_POST['defaultValue'];
$defaultValueId = 0;

// Validate the default values against value type chosen
if ($fieldType == 'integer')
{
    $defaultValue = (int)$defaultValue;

    // Insert the default value
    $defaultValueId = addIntFieldValue($defaultValue, $db);
}
elseif ($fieldType == 'string')
{
    if (strlen($defaultValue) == 0)
    {
        die('Please supply a valid string default value');
    }

    // Insert the default value
    $defaultValueId = addStringFieldValue($defaultValue, $db);
}
else
{
    // TODO Check for selections
}

// Sanity Check on default value
if ($defaultValueId == 0)
{
    die('Error creating the default value');
}

// Field Name
$fieldName = $_POST['fieldName'];

if (strlen($fieldName) == 0)
{
    die('Must have a field name');
}

// Count
$count = (int)$_POST['count'];

if ($count < 1)
{
    die('Invalid count value');
}
elseif ($count == 1 && $fieldType == 'selection')
{
    die('A selection of 1 item doesn\'t make sense');
}

// We have a selection choice
if ($count > 1)
{
    // Create array of options
    $optionArray = array();
    for($i=0; $i<$count-1; $i++)
    {
        if (!isset($_POST['option-'.$i]))
        {
            die('Error parsing options');
        }

        if (strlen($_POST['option-'.$count]) == 0)
        {
            die('Missing value for a selection');
        }

        $optionArray[] = $_POST['option-'.$count];
    }
}

// Club ID
$clubId = $_SESSION['club'];

if ($clubId == 0)
{
    die('Invalid club ID');
}

$fieldTypeId = addFieldType($fieldType);

// Save the options for the selection
if ($count > 2)
{
    addSelectValues($fieldTypeId, $optionArray);
}

addCustomField($fieldName, $fieldTypeId, $defaultValue, $defaultValueId, $clubId, $db);

header('Location: manageCustomFields.php');

?>
