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
	
	
//grab all ids
$idString = $_GET["ids"];
$token = strtok($idString, ",");
$idList = array();

while ($token !== false) {
	$idList[] = (int)$token;
    $token = strtok(",");
}

//Run delete
foreach ($idList as $id)
{
	//Remove item
	$sql = "Delete from inventory where inventory_id = '" . $id . "'";

	//Run update
	if(!mysqli_query($link, $sql))
		die("Query failed");
		
		
	//Remove any loan records
	$sql = "Delete from loans where inventory_id = '" . $id . "'";

	//Run update
	if(!mysqli_query($link, $sql))
		die("Query failed");
}


mysqli_close($link);
header('Location: viewinventory.php');
	
?>