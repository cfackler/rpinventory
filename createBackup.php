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


require_once( "lib/connect.lib.php" );  //mysql
require_once( "lib/auth.lib.php" );  //Session

// Authenticate
$auth = GetAuthority();	
if($auth<1)
  die("Please login to complete this action");

$link = connect();
if($link == null)
  die("Database connection failed");

require_once( "lib/config.class.php" );

$user = Config::get( 'database_username' );
$password = Config::get( 'database_password' );
$database = Config::get( 'database_name' );
$club_name = Config::get( 'club_name' );
$club_name = str_replace( ' ', '_', $club_name );
$sqlFile = "cache/". $club_name;

$createBackup = "mysqldump -u ".$user." --password=".$password." ".$database;

header( 'Content-type: text/plain' );
header( 'Content-Disposition: attachment; filename="'.$club_name."_backup.txt".'"' );

system($createBackup);

?>