<?php

/*

    Copyright (C) 2010, All Rights Reserved.

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
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	
if($auth < 2)
	die("You dont have permission to access this page");
	
//Username
$username = $_POST["username"];
if(strlen($username) == 0)
	die("Must have a description");

//Password
$password = $_POST["password"];


//Access level	
$access = (int)$_POST["access_level"];
if($access > 2 || $access < 2)
	die("Invalid access level");
	
	
//email
$email = $_POST["email"];
if(strlen($email) == 0)
	die("Must have a email");
	
//id
$id = (int)$_POST["id"];
if($id == 0)
	die("Invalid ID");

if (strlen($password) == 0)
{
    $user = getUser($id, $db);
    $password = $user->password;
}
else
{
    $password = md5($password);
}

updateUser($id, $username, $email, $password, $db);

$db->close();

header('Location: manageUsers.php');
	
?>
