<?php
// Login & Session example by sde
// auth.php

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