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
    along with Foobar.  If not, see <http://www.gnu.org/licenses/>.

*/

require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //Session

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();
if($auth != 2)
	die("You dont have permission to access this page");
	
//Username
$username = $_POST["username"];
if(strlen($username) == 0)
	die("Must have a username");

//Password
$password = $_POST["password"];
if(strlen($password) == 0)
	die("Must have a password");

//Access level	
$access = (int)$_POST["access_level"];
if($access > 2 || $access < 0)
	die("Invalid access level");		

//RIN
$rin = $_POST["rin"];
if(strlen($rin) == 0)
	die("Must have a RIN");
	
//email
$email = $_POST["email"];
if(strlen($email) == 0)
	die("Must have a email");
	
//email
$name = $_POST["name"];
if(strlen($name) == 0)
	die("Must have a name");

	
$sql = "INSERT INTO logins (id , username, password, access_level, rin, email, name) VALUES (NULL, '" . $username . "', '" . md5($password) . "', " . $access . ", '" . $rin . "', '" . $email . "', '" . $name . "')";	

	
if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: manageusers.php');
	
?>