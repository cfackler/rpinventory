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
require_once("lib/connect.lib.php");  //mysql
require_once("lib/auth.lib.php");  //Session

//Authenticate
$auth = GetAuthority();	
if($auth != 2)
  die("You dont have permission to access this page");

$link = connect();
if($link == null)
  die("Database connection failed");

//id
$id = (int)$_GET["id"];
if($id == 0)
  die("Invalid ID");
	
//Remove login
$sql = "DELETE FROM logins WHERE id = '" . $id . "'";
if(!mysqli_query($link, $sql))
  die("Query failed");
	
//Remove Address
$sql = "SELECT address_id FROM borrower_addresses WHERE user_id = '" . $id . "'";
$result = mysqli_query($link, $sql);
	
if(mysqli_num_rows($result) != 0)
  {
    $item = mysqli_fetch_object($result);
    $addyId = $item->address_id;
	
    if(!mysqli_query($link, "DELETE FROM borrower_addresses WHERE user_id = " . $id))
      die("Query failed");
		
    if(!mysqli_query($link, "DELETE FROM addresses WHERE address_id = " . $addyId))
      die("Query failed");
  }

mysqli_close($link);
header('Location: manageUsers.php');
	
?>