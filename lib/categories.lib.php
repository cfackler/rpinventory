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

function insertCategory($category_name, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    if(strlen($category_name) == 0)
    {
        die('Category must have a name');
    }

    // Club
    if (!isset($_SESSION['club']))
    {
        return 'failure';
    }
    
    $club_id = $_SESSION['club'];

    //check for duplicate category
    $query = 'SELECT category_name FROM categories WHERE category_name = ? AND club_id = ?';
    $result = $db->query($query, $category_name, $club_id);

    if(mysqli_num_rows($result) > 0 )
    {
        die('Category already exists.  Please choose from list.');
    }

    $query = 'INSERT INTO categories (category_name, club_id) VALUES (?, ?)';
    $db->query($query, $category_name, $club_id);

    if ($close)
    {
        $db->close();
    }

    return 'success';  
}

function get_item_category_ids($item_id, $store = 0, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    /* Store all category IDs into session variable if specified */
    if($store)
        $_SESSION['item_old_categoryIDs-'.$item_id] = array();

    if (!isset($_SESSION['club']))
    {
        return '';
    }

    $club_id = $_SESSION['club'];

    /* Retrieve all category IDs */
    $query = 'SELECT inventory_category.category_id
        FROM inventory_category
        WHERE inventory_category.inventory_id= ? AND club_id = ?';

    $result = $db->query($query, $item_id, $club_id);

    if (mysqli_num_rows($result) == 0)
    {
        die('Error, no categories retrieved');
    }

    $obj = $db->getObject($result);

    /* format the ids separated by commas 5,3,2 */
    $ids = $obj->category_id;

    if ($store)
    {
        $_SESSION['item_old_categoryIDs-'.$item_id][] = $ids;
    }

    while($id = $db->getObject($result))
    {
        if ($store)
        {
            $_SESSION['item_old_categoryIDs-'.$item_id] [] = $id->category_id;
        }

        $ids .= ','.$id->category_id;
    }

    if ($close)
    {
        $db->close();
    }

    return $ids;
}

?>
