<?php

require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //authentication


$link = connect();
if($link == null)
	die("Database connection failed");
	


//------- Page section --------

//Authenticate user
if(!Authenticate($_POST["username"], $_POST["password"], $link))
{
	//Logout and kill session
	Logout();
    
    header("location: login.php?login=fail");
    
    mysqli_close($link);
    die();
}

//Redirect to main page
header("location: viewinventory.php");

mysqli_close($link);

?>