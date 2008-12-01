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


	
// Business
$bus_id = (int)$_POST["business_id"];

if($bus_id == 0)
	die("Invalid Business ID");

if(!VerifyBusinessExists($bus_id, $link))
	die("Invalid Business");
	

$count = (int)$_POST['count'];
if($count == 0)
	die("invalid count");
	
//Date
$timestamp = mktime(0, 0, 0, (int)$_POST["months"], (int)$_POST["days"], (int)$_POST["year"]);	
$date = date("Y-m-d", $timestamp);


//Total cost
$cost = $_POST['total_cost'];	

	
//Insert purchase
$sql = "INSERT INTO purchases (purchase_id, business_id, purchase_date, total_price) VALUES
	(NULL, " . $bus_id . ", '" . $date . "', '" . $cost . "')";
		
if(!mysqli_query($link, $sql))
	die("Query failed");
	
//echo $sql . "<br>";
	
//ID
$purchase_id = mysqli_insert_id($link);
	
//All items
for($x=0; $x<$count; $x++)
{
	// Inventory Item
	$inv_id = (int)$_POST["inv_id" . $x];
	

	if($inv_id == 0)
		die("Invalid Inventory ID");

	if(!VerifyItemExists($inv_id, $link))
		die("Invalid Item");

	// Cost
	$cost = $_POST["cost" . $x];
	//if(!ereg("^[0-9]{1,7}.[0-9]{2}$", $cost))
	//	die("Cost must be of the form xxxx.xx");	
		
		
	$sql = "INSERT INTO purchase_items (purchase_id, inventory_id, cost) VALUES
	(" . $purchase_id .", " . $inv_id .", " . $cost .")";
	
	//echo $sql . "<br>";
	
	
	if(!mysqli_query($link, $sql))
		die("Query failed");
}
	

mysqli_close($link);
header('Location: viewPurchases.php');
	
?>
