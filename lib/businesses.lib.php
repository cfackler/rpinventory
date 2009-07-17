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


function getBusinesses()
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
  $query= "SELECT company_name, fax, email, website, address, address2, city, state, zipcode, phone FROM businesses, addresses WHERE businesses.address_id = addresses.address_id";

  $result = mysqli_query($link, $query) or
    die( 'Could not get the busineses' );

  $records = array();
  
  while($record = mysqli_fetch_object($result))
    {
      $records [] = $record;
    }
  
  mysqli_close($link);	
  
  return $records;
}

function getBusinessesOptions() {
		;
}

function getViewBusinesses( $currentSortIndex, $currentSortDir ){
  require_once("lib/connect.lib.php");  //mysql
  require_once("lib/auth.lib.php");  //Session

  $link = connect();
  if($link == null)
    die("Database connection failed");
  
  //Authenticate
  $auth = GetAuthority();	

  /* Determine query argument for sorting */
  if($currentSortIndex == 0)
    $sortBy = 'company_name';
  else if($currentSortIndex == 1)
    $sortBy = 'address';
  else if($currentSortIndex == 2)
    $sortBy = 'address2';
  else if($currentSortIndex == 3)
    $sortBy = 'city';
  else if($currentSortIndex == 4)
    $sortBy = 'state';
  else if($currentSortIndex == 5)
    $sortBy = 'zipcode';
  else if($currentSortIndex == 6)
    $sortBy = 'phone';  
  else if($currentSortIndex == 7)
    $sortBy = 'fax';
  else if($currentSortIndex == 8)
    $sortBy = 'email';
  else if($currentSortIndex == 9)
    $sortBy = 'website';
  
  /*  Determine query argument for sort direction
      Ascending is default    */
  if($currentSortDir == 1)
    $sortBy .= ' DESC';
  
  //users
  $query= "SELECT company_name, address, address2, city, state, zipcode, phone, fax, email, website
	     FROM businesses, addresses
	     WHERE businesses.address_id=addresses.address_id
	     ORDER BY ".$sortBy;
  
  $result = mysqli_query($link, $query);
  $businesses = array();
  
  while($business = mysqli_fetch_object($result)){
      $businesses [] = $business;
  }
  
  mysqli_close($link);
  
  return $businesses;
}

?>
