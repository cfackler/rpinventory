<?php
require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //Session

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
	die("You dont have permission to access this page");
	

//id
$id = (int)$_POST["loan_id"];
if($id == 0)
	die("Invalid ID");
	

$timestamp = mktime(0, 0, 0, (int)$_POST["months"], (int)$_POST["days"], (int)$_POST["year"]);	
$date = date("Y-m-d", $timestamp);
	
	
//Create query
$sql = "Update loans set return_date = '" . $date . "' where loan_id = " . $id;

//Run update
if(!mysqli_query($link, $sql))
	die("Query failed");


mysqli_close($link);	
header('Location: viewLoans.php');
	
?>