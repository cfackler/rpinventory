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
	die("Must have a description");

//Password
$password = $_POST["password"];


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
	
//id
$id = (int)$_POST["id"];
if($id == 0)
	die("Invalid ID");
	
	
//Create query
$sql = "Update logins set username = '" . $username . "', access_level = '" . $access . "', rin = '" . $rin . "', email = '" . $email . "', name = '" . $name . "'";


//Add password if changed
if(strlen($password) != 0)
{
	$pwd = md5($password);
	$sql .= ", password = '" . $pwd . "'";
}
	
$sql .= " where id = '" . $id . "'";


//Run update
if(!mysqli_query($link, $sql))
	die("Query failed");


mysqli_close($link);	
header('Location: manageUsers.php');
	
?>