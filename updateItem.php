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


require_once('lib/auth.lib.php');  //Session
require_once('lib/inventory.lib.php');
require_once('lib/fields.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();
if($auth < 1)
    die('You dont have permission to access this page');

$count = (int)$_POST['count'];
if($count == 0)
    die('Must edit at least one item');

$clubId = (int)$_SESSION['club'];
if ($clubId < 1)
{
    die('Invalid club id');
}

//Run update for each item
for($x=0; $x<$count; $x++)
{
    //Description
    $desc = $_POST['desc-' . $x];
    if(strlen($desc) == 0)
        die('Must have a description');


    //Condition
    $condition = $_POST['condition-' . $x];
    if(strlen($condition) == 0)
        die('Must have a condition');	

    //Location	
    $location = (int)$_POST['location-' . $x];

    //Value
    $value = (double)$_POST['value-' . $x];
    if($value == 0)
        die("Invalid Value");

    //Item ID
    $inventory_id = (int)$_POST['inventory_id-' . $x];
    if($inventory_id == 0)
        die('Invalid item id');	

    /**
     * Fields
     **/
    $fields = getInventoryCustomFields($clubId, $inventory_id, $db);

    // For each field
    foreach ($fields as &$field)
    {
        // Ensure a value was passed in
        if (!isset($_POST['field-'.$x.'-'.$field->field_id]))
        {
            die('Missing value for field: '.$field->field_name);
        }

        $newFieldValue = $_POST['field-'.$x.'-'.$field->field_id];

        // Integer fields
        if ($field->field_type_name == 'integer')
        {
            // Cast to the proper type
            $newFieldValue = (int)$newFieldValue;

            // Only update if the value has actually changed
            if ($field->value != $newFieldValue)
            {
                updateIntFieldValue($field->field_value_id, $newFieldValue, $db);
            }
        }   // String fields
        elseif ($field->field_type_name == 'string')
        {
            // Cast to the proper type
            $newFieldValue = (string)$newFieldValue;

            // Only update if the value has actually changed
            if ($field->value != $newFieldValue)
            {
                updateStringFieldValue($field->field_value_id, $newFieldValue, $db);
            }
        }
        elseif ($field->field_type_name == 'selection')
        {
            //TODO Add support for selection objects
            ;
        }
        else
        {
            die('Unsupported field type');
        }
    }

    /**
     *	Categories
     **/	

    /* All old categories are stored in session variables when editItem.php is loaded */	
    $currCatIDs = $_SESSION['item_old_categoryIDs-'.$inventory_id];

    /* Final categories can be retrieved from page */
    $finalCatIDs = array();

    // For all categories
    $sql = '';

    if(isset($_POST['category-'.$x]))
        $categories = $_POST['category-'.$x];

    if(isset($categories) && sizeof($categories) > 0)
    {
        for($c = 0; $c < sizeof($categories); $c++)
        {
            /* Put each final category into array */
            $finalCatIDs[] = $categories[$c];
        }

        /* categories to delete are the ones from the original that are not in the final */
        $toDeleteIDs = array_diff($currCatIDs, $finalCatIDs);
    }
    else
    {
        /* All categories should be removed */
        $toDeleteIDs = $currCatIDs;

    }

    if(sizeof($currCatIDs) > 0)
        /* categories to add are the ones from the final that are not in the original */
        $toAddIDs = array_diff($finalCatIDs, $currCatIDs);
    else
        /* Categories to add are just the ones from the page (final) */
        $toAddIDs = $finalCatIDs;

    // Remove old categories
    foreach($toDeleteIDs as &$category_id)
    {
        removeInventoryCategory($inventory_id, $category_id, $db);
    }

    // Add new categories
    foreach($toAddIDs as &$category_id)
    {
        addInventoryCategory($inventory_id, $category_id, $db);
    }

    updateInventory($inventory_id, $desc, $location, $condition, $value, $db);
}

$db->close();

header('Location: viewInventory.php');

?>
