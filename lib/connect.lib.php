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

require_once('lib/config.class.php');

function connect()
{
  $hostname = Config::get('database_hostname');
  $username = Config::get('database_username');
  $password = Config::get('database_password');
  $database = Config::get('database_name');
	
  $link = mysqli_connect($hostname,$username,$password);
  if($link == false)
    die("Can't Connect to the DB");
    
  mysqli_select_db($link, $database) or die("Unable to select database");

  return $link;
}

?>
