<?php
/*

  Copyright (C) 2008, All Rights Reserved.

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

function getViewCheckouts( $currentSortIndex, $currentSortDir ){
  require_once( 'lib/connect.lib.php' );

  $link = connect();
  if($link == null)
    die("Database connection failed");
  
  //Authenticate
  $auth = GetAuthority();	
  
  //items
  $query=   'SELECT checkout_id, checkouts.inventory_id, username, borrower_id, time_taken, time_returned, starting_condition, username, description
          FROM logins, checkouts, inventory 
          WHERE checkouts.borrower_id = logins.id and inventory.inventory_id = checkouts.inventory_id';
  
  
  //Filter
  if(!isset($_GET['view']))
    $view = "all";
  else
    $view = $_GET['view'];
  
  if($view == "outstanding")
    {
      $query .= ' and time_returned IS NULL';
    }
  else if($view == "returned")
    {
      $query .= ' and time_returned IS NOT NULL';
    }
  
  $query .= ' ORDER BY';
  
  /* Determine what column to sort by for SQL query */
  if($currentSortIndex == 0)
    $query .= ' description';
  else if($currentSortIndex == 1)
    $query .= ' starting_condition';
  else if($currentSortIndex == 2)
    $query .= ' username';
  else if($currentSortIndex == 3)
    $query .= ' time_taken';
  else if($currentSortIndex == 4)
    $query .= ' time_returned';
  
  /*  Determine query argument for sort direction
      Ascending is default    */
  if($currentSortDir == 1)
    $query .= ' DESC';
  
  $result = mysqli_query($link, $query) or die(mysqli_error($link));
  
  
  $items = array();
  
  while($item = mysqli_fetch_object($result))
    {
      $items [] = $item;
    }
  mysqli_close($link);
  
  return $items;
  
}

?>