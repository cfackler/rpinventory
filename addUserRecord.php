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

die($sql);
	
if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: manageusers.php');
	
?>