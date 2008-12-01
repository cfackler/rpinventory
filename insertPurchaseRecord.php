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
	

// Inventory Item
$inv_id = (int)$_POST["inv_id"];

if($inv_id == 0)
	die("Invalid Inventory ID");

if(!VerifyItemExists($inv_id, $link))
	die("Invalid Item");

// Cost
$cost = $_POST["total_cost"];
if(!ereg("^[0-9]{1,7}.[0-9]{2}$", $cost))
	die("Cost must be of the form xxxx.xx");


//Date
$timestamp = mktime(0, 0, 0, (int)$_POST["months"], (int)$_POST["days"], (int)$_POST["year"]);	
$date = date("Y-m-d", $timestamp);

	
$sql = "INSERT INTO purchases (purchase_id, business_id, purchase_date, total_price) VALUES
	(NULL, " . $bus_id . ", '" . $date . "', '" . $cost . "')";
		
if(!mysqli_query($link, $sql))
	die("Query failed");

// Get purchase_id of just inserted purchase
$sql = "SELECT purchase_id FROM purchases ORDER BY purchase_id DESC LIMIT 1";
$result = mysqli_query($link, $sql);
$purchase_id= mysqli_fetch_object($result);


$sql = "INSERT INTO purchase_items (purchase_id, inventory_id, cost) VALUES
	(" . $purchase_id->purchase_id .", " . $inv_id .", '" . $cost ."')";

if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: viewPurchases.php');
	
?>
