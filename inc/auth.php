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

// start session
session_start(); 


function Authenticate($username, $password, $link)
{

	$safeUsername = mysqli_real_escape_string($link, $username);
	$md5Password = md5($password);
	
	//Find user
	$result=mysqli_query($link, "select * from `logins` where username='" . $safeUsername . "' and password='" . $md5Password . "'");

	//verify count
	if(mysqli_num_rows($result) == 0)
		return false;

	$row = mysqli_fetch_object($result);
	
	//Verify row
	if($row == false)
		return false;	
	
	//Store id and auth
	$_SESSION['id'] = $row->id;
	$_SESSION['authority'] = $row->access_level;
	
	return true;
}



function Logout()
{
	unset($_SESSION['id']);
	unset($_SESSION['authority']);
	
	session_destroy();
}

//Verify id and authority set
function IsAuthenticated()
{
	if(isset($_SESSION['id']) && isset($_SESSION['authority']))
		return true;
		
	return false;
}

function GetAuthority()
{
	if(!IsAuthenticated())
		return null;
		
	return $_SESSION['authority'];
}

function VerifyUserExists($id, $link)
{
	
	//Find user
	$result=mysqli_query($link, "select * from `logins` where id=" . $id);

	//verify count
	if(mysqli_num_rows($result) == 0)
		return false;

	return true;
}

function VerifyBusinessExists($id, $link)
{
	//Find business
	$result=mysqli_query($link, "select * from `businesses` where business_id=" . $id);

	//verify count
	if(mysqli_num_rows($result) == 0)
		return false;

	return true;
}

function VerifyItemExists($id, $link)
{
	//Find Inventory Item
	$result=mysqli_query($link, "select * from `inventory` where inventory_id=" . $id);

	//verify count
	if(mysqli_num_rows($result) == 0)
		return false;

	return true;
}


?>