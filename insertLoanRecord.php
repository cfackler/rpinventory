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
$inventory_id = (int)$_POST["inventory_id"];
if($inventory_id == 0)
	die("Invalid ID");
	
//User
$user_id = (int)$_POST["user_id"];
if($user_id == 0)
	die("Invalid ID");

if(!VerifyUserExists($user_id, $link))
	die("Invalid User");
	
	
//Check item exists
$itemResult = mysqli_query($link, "select * from inventory where inventory_id=" . $inventory_id);
//verify count
if(mysqli_num_rows($itemResult) == 0)
	die("Invalid Item");
	
$item = mysqli_fetch_object($itemResult);

$timestamp = mktime(0, 0, 0, (int)$_POST["months"], (int)$_POST["days"], (int)$_POST["year"]);	
$date = date("Y-m-d", $timestamp);
	
$sql = "INSERT INTO loans (loan_id, inventory_id, user_id, issue_date, return_date, starting_condition) VALUES (NULL, " . $inventory_id . ", " . $user_id . ", '" . $date . "', NULL, '" . $item->current_condition . "'	)";	

	
if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: viewinventory.php');
	
?>