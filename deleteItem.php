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
$id = (int)$_GET["id"];
if($id == 0)
	die("Invalid ID");


$sure = $_GET['sure'];
//Make sure they want to delete
if($sure != "yes")
{
	echo "<h1>Are you sure?</h1>";
	echo "<a href=\"deleteItem.php?id=" . $id . "&sure=yes\">Yes</a><br><br>";
	echo "<a href=\"viewinventory.php\">No</a><br>";
	
	die("");
}


	
//Create query
$sql = "Delete from inventory where inventory_id = '" . $id . "'";


//Run update
if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: viewinventory.php');
	
?>