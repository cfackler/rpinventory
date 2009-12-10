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


function getBorrowers()
{
  require_once("lib/connect.lib.php");  //mysql
  require_once("lib/auth.lib.php");  //Session

  // Connect
  $link = connect();
  if( $link == null )
    die( "Database connection failed" );
  
  // Authenticate
  $auth = GetAuthority();
  
  // Borrowers
  $query= "SELECT * FROM borrowers";

  $result = mysqli_query($link, $query) or
    die( 'Could not get the borrowers' );

  $records = array();
  
  while($record = mysqli_fetch_object($result))
    {
      $records [] = $record;
    }
  
  mysqli_close($link);	
  
  return $records;
}

/* Return the name of the borrower given an id */
function getBorrowerName($id) {
  require_once("lib/connect.lib.php");  //mysql
	require_once("lib/auth.lib.php");  //Session

	// Connect
	$link = connect();
	if( $link == null )
		die( "Database connection failed" );

	// Authenticate
	$auth = GetAuthority();

	$id = (int)$id;
	if($id == 0)
		die('ID cannot be zero');

	// Borrowers
	$query= "SELECT name FROM borrowers WHERE borrower_id = ". $id;

	$result = mysqli_query($link, $query) or
		die( 'Could not get the borrowers' );

	$name = mysqli_fetch_object($result);

	mysqli_close($link);

	return $name->name;
}


function getBorrowerNames( $name )
{
  require_once( 'modules/json/JSON.php' );
  require_once( 'lib/connect.lib.php' );
  require_once( 'lib/auth.lib.php' );

  // Connect
  $link = connect();
  if( $link == null )
    die( "Database connection failed" );
  
  // Authenticate
  $auth = GetAuthority();
  if($auth < 1)
	  die("You dont have permission to access this page");

  $sql = 'SELECT name FROM borrowers';

  $result = mysqli_query( $link, $sql ) or
    die( 'Could not get the names' );

  $records = array();
 
  while ( $record = mysqli_fetch_object( $result ) ){
    if ( preg_match( '/'.$name.'/i', $record->name ) ) {
      $records[] = $record->name;
    }
  }

  $data = array( "records" => $records );
  mysqli_close( $link );
 
  $json = new Services_JSON();
  
  header('X-JSON: ('.$json->encode( $data ).')');
}

function getViewBorrowers( $currentSortIndex=0, $currentSortDir=0 ){
  require_once("lib/connect.lib.php");  //mysql
  require_once("lib/auth.lib.php");  //Session

  // Connect
  $link = connect();
  if( $link == null )
    die( "Database connection failed" );
  
  // Authenticate
  $auth = GetAuthority();

  /* Determine query argument for sorting */
  if($currentSortIndex == 0)
    $sortBy = 'name';
  else if($currentSortIndex == 1)
    $sortBy = 'rin';
  else if($currentSortIndex == 2)
    $sortBy = 'email';
  
  /*  Determine query argument for sort direction
      Ascending is default    */
  if($currentSortDir == 1)
    $sortBy .= ' DESC';
  
  
  //users
  $borrowersQuery= "SELECT * from borrowers ORDER BY ".$sortBy;
  $borrowerResult = mysqli_query($link, $borrowersQuery);
  $borrowers = array();
  
  while($borrower = mysqli_fetch_object($borrowerResult))
    {
      $borrowers [] = $borrower;
    }
  mysqli_close($link);

  return $borrowers;
}

function getBorrower( $id ) {
	require_once('lib/connect.lib.php');
	require_once('lib/auth.lib.php');

	// Database
	$link = connect();
	if( $link == null )
		die( 'Database connection failed' );

	// Authority
	$auth = GetAuthority();

	// Sanitize
	$id = (int)$id;

	$sql = 'SELECT * FROM borrowers WHERE borrower_id = ' . $id;

    $result = mysqli_query($link, $sql) or
        die('Borrower query failed');
	$borrower = mysqli_fetch_object($result);

	return $borrower;
}

function insertBorrower( $name, $rin, $email, $address, $address2, $city, $state, $zip, $phone ) {
	require_once( 'modules/json/JSON.php' );
	require_once('lib/connect.lib.php');
	require_once('lib/auth.lib.php');

	// Database
	$link = connect();
	if( $link == null )
		die( 'Database connection failed' );

	// Authority
	$auth = GetAuthority();

	$data = Array( "response" => '' );
	$json = new Services_JSON();

	// Sanitize
	$name			= mysqli_real_escape_string($link, $name);
	$rin			= mysqli_real_escape_string($link, $rin);
	$email		= mysqli_real_escape_string($link, $email);
	$address	=	mysqli_real_escape_string($link, $address);
	$address2	=	mysqli_real_escape_string($link, $address2);
	$city			=	mysqli_real_escape_string($link, $city);
	$state		=	mysqli_real_escape_string($link, $state);
	$zip			=	mysqli_real_escape_string($link, $zip);
	$phone		=	mysqli_real_escape_string($link, $phone);

	// Duplicate check
	$sql = 'SELECT rin, email FROM borrowers WHERE rin = "'. $rin .'" OR email = "'. $email .'" LIMIT 1';
	$result = mysqli_query($link, $sql);

	// Check to make sure a duplicate RIN or email is not given
	if( mysqli_num_rows($result) != 0 ) {
		$obj = mysqli_fetch_object($result);
		
		if( $obj->rin == $rin ) {
			$data['response'] = 'Duplicate RIN entered!';
		}
		else {
			$data['response'] = 'Duplicate email entered!';
		}
		
		header('X-JSON: ('.$json->encode($data ).')');
		exit();
	}

	$sql = 'INSERT INTO addresses (address_id, address, address2, city, state, zipcode, phone) VALUES (NULL, "'. $address .'", "'. $address2 .'", "'. $city .'", "'. $state .'", "'. $zip .'", "'. $phone .'")';
	$result = mysqli_query($link, $sql);
	if( !$result ){
		die('Could not insert the address');
	}

	$address_id = mysqli_insert_id($link);	// Insert the borrower

	$sql = 'INSERT INTO borrowers (borrower_id, address_id, name, rin, email) VALUES (NULL, '. $address_id .', "'. $name .'", "'. $rin .'", "'. $email .'")';
	$result = mysqli_query($link, $sql);
	if( !$result ) {
		die('Could not insert the borrower');
	}


	header('X-JSON: ('.$json->encode($data).')');
}

?>
