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
	
//id
$id = (int)$_POST["id"];
if($id == 0)
	die("Invalid ID");
	
	
//Create query
$sql = "Update logins set username = '" . $username . "', access_level = '" . $access . "'";

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
header('Location: manageusers.php');
	
?>