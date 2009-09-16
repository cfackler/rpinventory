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
  require_once('lib/connect.lib.php');  //mysql
  require_once('lib/auth.lib.php');  //Session

  // Connect
  $link = connect();
  if( $link == null )
    die( 'Database connection failed' );
  
  // Authenticate
  $auth = GetAuthority();

  $startDate = mysqli_real_escape_string( $link, $startDate );
  $endDate = mysqli_real_escape_string( $link, $endDate);
  
  // Loan History
  $query= 'SELECT business_id, company_name, fax, email, website, address, address2, city, state, zipcode, phone FROM businesses, addresses WHERE businesses.address_id = addresses.address_id';

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

// Returns HTML for the content of a drop-down 'select' box
function getBusinessesOptions() {
	$output = '';

	$businesses = getBusinesses();	

	$output .= '<option value="-1">Select a Business</option>'.'\n';

	foreach( $businesses as $business ) {
		$output .= '<option value="'.$business->business_id.'">';
		$output .= $business->company_name . '</option>\n';
	}

	$output .= '<option value="newBusiness">Add a New Business</option>\n';

	return $output;
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

function insertBusiness( $company, $address, $address2, $city, $state, $zip, $phone, $fax, $email, $website ) {
  require_once('lib/connect.lib.php');  //mysql
  require_once('lib/auth.lib.php');  //Session
  //echo $fax;
  
  // Authenticate
  $auth = GetAuthority();	
  if($auth<1)
    die('Please login to complete this action');
  
  $link = connect();
  if($link == null)
    die('Database connection failed');

  if( strlen( $company ) == 0 ) {
	  die( 'Must have a company name' );
  }

  if( strlen( $address )  == 0 ) {
	  die( 'Must have an address' );
  }

  if( strlen( $city )  == 0 ) {
	  die( 'Must have a city' );
  }

  if( strlen( $state ) == 0 ) {
	  die( 'Must have a state' );
  }

  if( strlen( $zip ) == 0 ) {
	  die( 'Must have a zip' );
  }

  if( strlen( $phone ) == 0 ) {
	  die( 'Must have a phone number' );
  }

  if( strlen( $address2 )  == 0 ) {
	  $address2 = null;
  }

  if( strlen( $fax ) == 0 ) {
	  $fax = null;
  }

  if( strlen( $email ) == 0 ) {
	  $email = null;
  }

  if( strlen( $website ) == 0 ) {
	  $website = null;
  }
  //echo $fax;

  //die($company);
  $company = mysqli_real_escape_string( $link, $company );
  $address = mysqli_real_escape_string( $link, $address );
  $address2 = mysqli_real_escape_string( $link, $address2 );
  $city = mysqli_real_escape_string( $link, $city );
  $state = mysqli_real_escape_string( $link, $state );
  $zip = mysqli_real_escape_string( $link, $zip );
  $phone = mysqli_real_escape_string( $link, $phone );
  $fax = mysqli_real_escape_string( $link, $fax );
  $email = mysqli_real_escape_string( $link, $email );
  $website = mysqli_real_escape_string( $link, $website );

  //echo $fax;
  $sql = 'INSERT INTO addresses (address_id, address, address2, city, state, zipcode, phone) VALUES ( NULL, "'. $address .'", "'. $address2 .'", "'.  $city .'", "'. $state .'", "'. $zip .'", "'. $phone .'")';

  if( !mysqli_query( $link, $sql ) ){
	  die( 'Address insert query failed' );
  }

  $address_id = mysqli_insert_id( $link );


  $sql = 'INSERT INTO businesses (business_id, address_id, company_name, fax, email, website) VALUES ( NULL, '. $address_id .', "'. $company .'", "'. $fax .'", "'. $email .'", "'. $website .'")';
  //echo $sql;

  if( !mysqli_query( $link, $sql ) ) {
	  die( 'Business insert query failed' );
  }

  mysqli_close( $link );
	return 'success';
}

?>
