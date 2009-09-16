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

/* Takes two dates, formatted as YYYY-MM-DD */
function getRepairs( $startDate, $endDate )
{
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
  
  // Loan History
  $query= "SELECT repairs.description AS repair_description, repair_cost, repair_date, company_name, inventory.description AS inventory_description FROM repairs, inventory, businesses WHERE repairs.inventory_id = inventory.inventory_id AND repairs.business_id = businesses.business_id AND repair_date >= '". $startDate ."' AND repair_date <= '". $endDate ."'";

  $result = mysqli_query($link, $query) or
    die( 'Could not get the repair history' );

  $records = array();
  
  while($record = mysqli_fetch_object($result))
    {
      $records [] = $record;
    }
  
  mysqli_close($link);	
  
  return $records;
}

function getViewRepairs( $currentSortIndex, $currentSortDir ){
  require_once("lib/connect.lib.php");  //mysql
  require_once("lib/auth.lib.php");  //Session

  $link = connect();
  if($link == null)
    die("Database connection failed");

  $auth = getAuthority();

  /* Determine query argument for sorting */
  if($currentSortIndex == 0)
    $sortBy = 'inv_description';
  else if($currentSortIndex == 1)
    $sortBy = 'company_name';
  else if($currentSortIndex == 2)
    $sortBy = 'repair_date';
  else if($currentSortIndex == 3)
    $sortBy = 'repair_cost';
  else if($currentSortIndex == 4)
    $sortBy = 'rep_description';
  
  /*  Determine query argument for sort direction
      Ascending is default    */
  if($currentSortDir == 1)
    $sortBy .= ' DESC';
  
  //items
  $query= "SELECT inventory.description AS inv_description, company_name, repairs.business_id, repair_date, repair_cost, repairs.description AS rep_description
	 FROM repairs, inventory, businesses
	 WHERE repairs.inventory_id=inventory.inventory_id AND repairs.business_id=businesses.business_id ORDER BY ".$sortBy;
  
  
  $result = mysqli_query($link, $query);
  $items = array();
  
  while($item = mysqli_fetch_object($result))
    {
      $items [] = $item;
    }
  
  mysqli_close($link);
  
  return $items;
}

?>