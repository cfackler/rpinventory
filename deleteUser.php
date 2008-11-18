<?php
require_once("inc/connect.php");  //mysql

$link = connect();
if($link == null)
	die("Database connection failed");

//id
$id = (int)$_GET["id"];
if($id == 0)
	die("Invalid ID");


$sure = $_GET['sure'];
//Make sure they want to delete
if($sure != "yes")
{
	echo "<h1>Are you sure?</h1>";
	echo "<a href=\"deleteUser.php?id=" . $id . "&sure=yes\">Yes</a><br><br>";
	echo "<a href=\"manageusers.php\">No</a><br>";
	
	die("");
}


	
//Create query
$sql = "Delete from logins where id = '" . $id . "'";


//Run update
if(!mysql_query($sql, $link))
	die("Query failed");

	
header('Location: manageusers.php');
	
?>