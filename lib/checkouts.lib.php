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

function getCheckout($checkoutId){
  require_once("lib/connect.lib.php");  //mysql
  require_once("lib/auth.lib.php");  //Session

  // Connect
  $link = connect();
  if( $link == null )
    die( "Database connection failed" );
  
  // Authenticate
  $auth = GetAuthority();

  $sql = 'SELECT inventory.description, borrowers.name, checkouts.time_taken, locations.location, original_location_id FROM checkouts, inventory, borrowers, locations WHERE checkouts.checkout_id = '. $checkoutId .' AND checkouts.inventory_id = inventory.inventory_id AND checkouts.borrower_id = borrowers.borrower_id AND locations.location_id = checkouts.original_location_id';

  $result = mysqli_query($link, $sql) or
    die( 'Error: '.mysqli_error($link));

  $checkout = mysqli_fetch_object($result);

  return $checkout;
}

function getCheckouts( $startDate, $endDate ){
  require_once("lib/connect.lib.php");  //mysql
  require_once("lib/auth.lib.php");  //Session

  // Connect
  $link = connect();
  if( $link == null )
    die( "Database connection failed" );
  
  // Authenticate
  $auth = GetAuthority();

  $startDate = mysqli_real_escape_string( $link, $startDate );
  $endDate = mysqli_real_escape_string( $link, $endDate);
  
  // Checkout History
  $query= "SELECT time_taken, time_returned, event_name, starting_condition, ending_condition, inventory.description, username, original_location_id FROM checkouts, inventory, logins WHERE logins.id = checkouts.borrower_id AND checkouts.inventory_id = inventory.inventory_id AND time_taken >= '". $startDate ."' AND (time_returned <= '". $endDate ."' OR time_returned IS NULL)";

  //  echo $query;
  $result = mysqli_query($link, $query) or
    die( 'Could not get the checkout history' );

  $records = array();
  
  while($record = mysqli_fetch_object($result))
    {
      $records [] = $record;
    }
  
  mysqli_close($link);	
  
  return $records;

}

function getViewCheckouts( $currentSortIndex, $currentSortDir ){
  require_once( 'lib/connect.lib.php' );

  $link = connect();
  if($link == null)
    die("Database connection failed");
  
  //Authenticate
  $auth = GetAuthority();	
  
  //items
  $query=   'SELECT checkout_id, checkouts.inventory_id, username, borrower_id, time_taken, time_returned, starting_condition, username, description, original_location_id
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
