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

function getInventory($sortIndex = 0, $sortdir = 0)
{
  require_once("lib/connect.lib.php");  //mysql
  require_once("lib/auth.lib.php");  //Session
  
  $link = connect();
  if($link == null)
    die("Database connection failed");
  
  //Authenticate
  $auth = GetAuthority();
  
  //Determine which column to sort by
  if($sortIndex == 0)
    $sortBy = 'description';
	else if($sortIndex == 1)
		$sortBy = 'description';
  else if($sortIndex == 2)
    $sortBy = 'current_condition';
  else if($sortIndex == 3)
    $sortBy = 'current_value';
  else if($sortIndex == 4)
    $sortBy = 'location';
  
  //Determine which direction to sort in
  if($sortdir == 0)
    $sortdir = ''; //query ascends by default
  else
    $sortdir = "DESC";
  
  //items
  $query= "SELECT inventory.inventory_id, inventory.description, location, current_condition, current_value
				FROM inventory, locations
				WHERE locations.location_id=inventory.location_id
				ORDER BY ".$sortBy." ".$sortdir;
  $result = mysqli_query($link, $query) or
    die( 'Could not retrieve the inventory' );
  $items = array();
  
  while($item = mysqli_fetch_object($result))
    {
        if( $item->location == "On Loan" ) {
            $sql = 'SELECT loan_id FROM loans WHERE inventory_id = ' . $item->inventory_id . ' AND return_date is NULL';
            $loan_result = mysqli_query( $link, $sql ) or
                die( "Error: ". mysql_error() );

            $loan_item = mysqli_fetch_object( $loan_result );

            $item->loan_id = $loan_item->loan_id;
            $item->checkout_id = 0;
        }
        else if($item->location == "Checked Out") {
            $sql = 'SELECT checkout_id FROM checkouts WHERE inventory_id = ' . $item->inventory_id .' AND time_returned is NULL';
            $checkout_result = mysqli_query($link, $sql) or
                die('Error: '.mysql_error());

            $checkout_item = mysqli_fetch_object($checkout_result);

            $item->checkout_id = $checkout_item->checkout_id;
            $item->loan_id = 0;
        }
        else {
            $item->loan_id = 0;
            $item->checkout_id = 0;
        }
				
				//Get categories of item
				$sql = 'SELECT category_id FROM inventory_category WHERE inventory_id="'.$item->inventory_id.'"';
				$catIDsResult = mysqli_query($link, $sql) or die('Error getting categories: '.mysqli_error($link) );
				if(mysqli_num_rows($catIDsResult) > 0)
				{
					//first category ID
					$cat_id = mysqli_fetch_object($catIDsResult)->category_id;
					$sql = 'SELECT category_name FROM categories WHERE id="'.$cat_id.'"';
					//if multiple categories
					while($cat_id = mysqli_fetch_object($catIDsResult))
					{
						$sql .= 'OR id="'.$cat_id->category_id.'"';
					}
					$catNamesResult = mysqli_query($link, $sql) or die('Error getting category names: '.mysqli_error($link));

					//format category names
					$categories = mysqli_fetch_object($catNamesResult)->category_name;
					while($cat_name = mysqli_fetch_object($catNamesResult))
					{
						$categories .= ', '.$cat_name->category_name;
					}
					$item->category = $categories;
				}
				
        $items [] = $item;
    }

  mysqli_close($link);	

  return $items;
}

?>
