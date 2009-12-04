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

  // determine whether to limit inventory only to one club
  if (isset($_SESSION['club']))
     $clublimit = ' AND inventory.club_id = ' . $_SESSION['club'];
  else
    $clublimit = '';

  //items
  $query= "SELECT inventory.inventory_id, inventory.description, location, current_condition, current_value, clubs.club_name
				FROM inventory, locations, clubs
				WHERE inventory.club_id = clubs.club_id AND locations.location_id=inventory.location_id" . $clublimit . "
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
				$sql = 'SELECT categories.category_name
								FROM inventory_category, categories
								WHERE inventory_category.inventory_id="'.$item->inventory_id.'"
								AND categories.id=inventory_category.category_id';
				$cat_names = mysqli_query($link, $sql) or die('Error getting categories: '.mysqli_error($link) );
				
				//If an item has no categories, just put "Uncategorized" into field
				if(mysqli_num_rows($cat_names) == 0)
				{
					$categoryString = 'Uncategorized';
				}
				else
				{
					//format category names
					$categoryString = mysqli_fetch_object($cat_names)->category_name;
					while($cat_name = mysqli_fetch_object($cat_names))
					{
						$categoryString .= ', '.$cat_name->category_name;
					}
				}

				$item->category = $categoryString;
				
        $items [] = $item;
    }

  mysqli_close($link);	

  return $items;
}

?>
