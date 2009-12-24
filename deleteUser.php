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

require_once('lib/users.lib.php');
require_once("lib/auth.lib.php");  //Session

//Authenticate
$auth = GetAuthority();	
if ($auth != 2)
{
    die("You dont have permission to access this page");
}

//id
$id = (int)$_GET["id"];
if ($id == 0)
{
    die("Invalid ID");
}

//Remove login
deleteUser($id);

header('Location: manageUsers.php');

?>
