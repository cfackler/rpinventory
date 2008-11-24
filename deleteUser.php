<?php
require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //Session

$link = connect();
if($link == null)
	die("Database connection failed");
	

//Authenticate
$auth = GetAuthority();	
if($auth != 2)
	die("You dont have permission to access this page");
	

//id
$id = (int)$_GET["id"];
if($id == 0)
	die("Invalid ID");
	
//Remove login
$sql = "Delete from logins where id = '" . $id . "'";
if(!mysqli_query($link, $sql))
	die("Query failed");
	
//Remove Address
$sql = "select address_id from borrower_addresses where user_id = '" . $id . "'";
$result = mysqli_query($link, $sql);
	
if(mysqli_num_rows($result) != 0)
{
	$item = mysqli_fetch_object($result);
	$addyId = $item->address_id;
	
	if(!mysqli_query($link, "delete from borrower_addresses where user_id = " . $id))
		die("Query failed");
		
	if(!mysqli_query($link, "delete from addresses where address_id = " . $addyId))
		die("Query failed");
}

mysqli_close($link);
header('Location: manageusers.php');
	
?>