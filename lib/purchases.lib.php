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
function getPurchases( $startDate, $endDate )
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
  $query= "SELECT purchase_date, purchases.purchase_id, company_name, description, cost FROM purchases, purchase_items, businesses, inventory WHERE purchase_items.inventory_id = inventory.inventory_id AND purchase_items.purchase_id = purchases.purchase_id AND purchases.business_id = businesses.business_id AND purchase_date >= '". $startDate ."' AND purchase_date <= '". $endDate ."'";

  $result = mysqli_query($link, $query) or
    die( 'Could not get the purchase history' );

  $records = array();
  
  while($record = mysqli_fetch_object($result))
    {
      $records [] = $record;
    }
  
  mysqli_close($link);	
  
  return $records;
}

function getViewPurchases( $currentSortIndex=0, $currentSortDir=0 ){
  require_once( 'lib/connect.lib.php' );
  require_once( 'lib/auth.lib.php' );

  $link = connect();
  if( $link == null )
    die( "Database connection failed" );
  
  // Authenticate
  $auth = GetAuthority();

  /* Determine query argument for sorting */
  if($currentSortIndex == 0)
    $sortBy = 'purchase_id';
  else if($currentSortIndex == 1)
    $sortBy = 'company_name';
  else if($currentSortIndex == 2)
    $sortBy = 'purchase_date';
  else if($currentSortIndex == 3)
    $sortBy = 'total_price';
  
  /*  Determine query argument for sort direction
      Ascending is default    */
  if($currentSortDir == 1)
    $sortBy .= ' DESC';
  
  //users
  $query= "SELECT purchases.purchase_id, purchases.business_id, purchases.purchase_date, company_name, total_price
	 FROM purchases, businesses
	 WHERE businesses.business_id=purchases.business_id ORDER BY ".$sortBy;
  $result = mysqli_query($link, $query);
  $purchases = array();
  $items = array();
  
  while($purchase = mysqli_fetch_object($result)){
    $itemQuery = "select purchase_id, description from inventory, purchase_items where inventory.inventory_id = purchase_items.inventory_id and purchase_items.purchase_id = " . $purchase->purchase_id;
    
    $itemResult = mysqli_query($link, $itemQuery);
    $string = "";
    
    while($item = mysqli_fetch_object($itemResult)){
      if(strlen($string) != 0)
	$string .= ", ";
      
      $string .= $item->description;
    }
    
    $purchase->items = $string;
    
    $purchases[] = $purchase;
    
  }
  
  mysqli_close($link);
  
  return $purchases;  
}

?>