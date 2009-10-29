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


function getUsers()
{
  require_once("lib/connect.lib.php");  //mysql
  require_once("lib/auth.lib.php");  //Session

  // Connect
  $link = connect();
  if( $link == null )
    die( "Database connection failed" );
  
  // Authenticate
  $auth = GetAuthority();
  
  // Users
  $query= "SELECT username, email, access_level FROM logins";

  $result = mysqli_query($link, $query) or
    die( 'Could not get the users' );

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

function getViewUsers( $currentSortIndex=0, $currentSortDir=0 ){
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
    $sortBy = 'username';
  else if($currentSortIndex == 1)
    $sortBy = 'access_level';
  else if($currentSortIndex == 2)
    $sortBy = 'email';
  
  /*  Determine query argument for sort direction
      Ascending is default    */
  if($currentSortDir == 1)
    $sortBy .= ' DESC';
  
  
  //users
  $userQuery= "SELECT * from logins ORDER BY ".$sortBy;
  $userResult = mysqli_query($link, $userQuery);
  $users = array();
  
  while($user = mysqli_fetch_object($userResult))
    {
      $users [] = $user;
    }
  mysqli_close($link);

  return $users;
}
?>
