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
    $sortBy = 'current_condition';
  else if($sortIndex == 2)
    $sortBy = 'current_value';
  else if($sortIndex == 3)
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
      $items [] = $item;
    }
  
  mysqli_close($link);	
  
  return $items;
}

?>