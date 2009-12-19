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
  require_once('class/database.class.php');  //mysql
  require_once("lib/auth.lib.php");  //Session

  // Database
  $db = new database();
  
  // Authenticate
  $auth = GetAuthority();

  // Need to be administrator 
  if ($auth < 2)
  {
    return array();
  }

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

  if (!isset($_SESSION['club']))
  {
      return array();
  }  
  
  //users
  $sql = "SELECT * from logins, user_clubs WHERE user_clubs.user_id = logins.id AND user_clubs.club_id = ". $_SESSION['club'] ." ORDER BY ".$sortBy;

  $result = $db->query($sql);

  return $db->getObjectArray($result);
}

// Add a new user and link them to the current club
function addUser($username, $password, $accessLevel, $email, $clubId)
{
    require_once('class/database.class.php');  //mysql

    // Database connection
    $db = new database();

    // Insert the new user
    $sql = 'INSERT INTO logins (id, username, password, email) VALUES (NULL, ?, ?, ?)';
    $db->query($sql, $username, $password, $email);

    // Link the user to the current club
    $sql = 'INSERT INTO user_clubs (user_id, club_id, access_level) VALUES (?, ?, ?)';
    $db->query($sql, $db->insertId(), $clubId, $accessLevel);

    // Close the connection
    $db->close();
}

?>
