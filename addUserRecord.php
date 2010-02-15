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

require_once('lib/auth.lib.php');  //Session
require_once('lib/users.lib.php'); // User library
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();
if ($auth < 2)
{
    die("You dont have permission to access this page");
}

//Username
$username = $_POST["username"];
if(strlen($username) == 0)
    die("Must have a username");
if(!preg_match('/^[a-z\d_]{4,20}$/i', $username))
    die("Invalid username $username");

//Password
$password = $_POST["password"];
if(strlen($password) == 0)
    die("Must have a password");

//Access level	
$access = (int)$_POST["access_level"];
if($access > 3 || $access < 1)
    die("Invalid access level");		

//email
$email = $_POST["email"];
if(strlen($email) == 0)
    die("Must have a email");

// Check club id in session
if (!isset($_SESSION['club']))
{
    die('Must have a club ID');
}

// Ensure you have permission to make an admin account
if ($access > 2)
{
    if ($auth < 3)
    {
        die('Insufficient permission');
    }
}

addUser($username, md5($password), $access, $email, $_SESSION['club'], $db);

$db->close();

header('Location: manageUsers.php');

?>
