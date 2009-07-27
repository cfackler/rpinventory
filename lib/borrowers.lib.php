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

function getUsernames( $name )
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

  $sql = 'SELECT username FROM logins';

  $result = mysqli_query( $link, $sql ) or
    die( 'Could not get the usernames' );

  $records = array();
 
  while ( $record = mysqli_fetch_object( $result ) ){
    if ( preg_match( '!^'.$name.'!', $record->username ) ) {
      $records[] = $record->username;
    }
  }

  $data = array( "records" => $records );
  mysqli_close( $link );
 
  $json = new Services_JSON();
  
  header('X-JSON: ('.$json->encode( $data ).')');
}

function getViewBorrowers( $currentSortIndex, $currentSortDir ){
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

	$result = mysqli_query($link, $sql);
	$borrower = mysqli_fetch_object($result);

	return $borrower;
}

?>
