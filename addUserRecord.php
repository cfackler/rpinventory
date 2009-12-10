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

require_once('class/database.class.php');  //mysql
require_once('lib/auth.lib.php');  //Session

// Database connection
$db = new database();

//Authenticate
$auth = GetAuthority();
if ($auth != 2)
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
if($access > 2 || $access < 0)
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
	
// Insert into logins
$sql = 'INSERT INTO logins (id , username, password, email) VALUES (NULL, ?, ?, ?)';
$db->query($sql, $username, md5($password), $email);

// Add login record to user_clubs
$sql = 'INSERT INTO user_clubs (user_id, club_id, access_level) VALUES (?, ?, ?)';
$db->query($sql, $db->insertId(), $_SESSION['club'], $access);

$db->close();

header('Location: manageUsers.php');
	
?>
