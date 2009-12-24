<?php

function insertCategory($category_name)
{
    require_once('class/database.class.php');
    require_once('lib/auth.lib.php');  //Session

    // Authenticate
    $auth = GetAuthority();	
    if($auth<1)
        die('Please login to complete this action');

    $db = new database();

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

    $db->close();

    return 'success';  
}

function get_item_category_ids($item_id, $store = 0)
{
    require_once('class/database.class.php');
    require_once('lib/auth.lib.php');  //Session
    session_start();

    /* Store all category IDs into session variable if specified */
    if($store)
        $_SESSION['item_old_categoryIDs-'.$item_id] = array();

    // Authenticate
    $auth = GetAuthority();	
    if($auth<1)
        die('Please login to complete this action');

    $db = new database();

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

    $db->close();

    return $ids;
}

?>
