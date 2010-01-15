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
require_once("lib/auth.lib.php");  //Session
require_once('lib/users.lib.php');
require_once('lib/clubs.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	
if ($auth < 2)
{
    die("You dont have permission to access this page");
}

//id
$club_id = (int)$_GET['club_id'];
if ($club_id == 0)
{
    die("Invalid ID");
}

$user_id = (int)$_GET['user_id'];
if ($user_id == 0)
{
    die('Invalid user id');
}

// Delete the club
removeUserFromClub($user_id, $club_id, $db);

$db->close();

header('Location: editClub.php?id='.$club_id);

?>
