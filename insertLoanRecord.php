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
	
//Address INFO


$useOld = $_POST["useOld"];
$oldExists = false;
//Check if old address exists

$query= "SELECT *  FROM addresses, borrower_addresses WHERE addresses.address_id = borrower_addresses.address_id and borrower_addresses.user_id = " . $user_id . " LIMIT 1";
$result = mysqli_query($link, $query);
$addyResult = null;
if(mysqli_num_rows($result) != 0)
{
	$oldExists = true;
	$addyResult = mysqli_fetch_object($result);
}

if($useOld == "on" && $oldExists == false)
	die("Old address doesnt exist");
    
echo $useOld;    
    
if($useOld == "off")
{
    echo "insert/update addy";

	$address = $_POST["address"];
	$address2 = $_POST["address2"];
	if($address2 == null)
		$address2="";
	
	$city = $_POST["City"];
	$state = $_POST["State"];
	$zipcode = $_POST["Zipcode"];
	$phone = $_POST["Phone"];
	
	
	if(strlen($address) == 0 || strlen($city) == 0 || strlen($state) == 0 || strlen($zipcode) == 0 || strlen($phone) == 0)
		die("Null values not allowed");
		
	if(!$oldExists)
	{
		$query = "insert into addresses (address_id, address, address2, city, state, zipcode, phone) VALUES(NULL, '" . $address . "', '" . $address2 . "', '" . $city . "', '" . $state . "', '" . $zipcode . "', '" . $phone . "')";
		
		if(!mysqli_query($link, $query))
			die("Query failed");
		$address_id = mysqli_insert_id($link);
		
		$query = "insert into borrower_addresses (user_id, address_id) VALUES(" . $user_id . ", " . $address_id . ")";
		if(!mysqli_query($link, $query))
			die("Query failed");
	}
	else
	{
		$query = "update addresses set address='" . $address . "', address2='" . $address2 . "', city='" . $city . "', state='" . $state . "', zipcode='" . $zipcode . "', phone='" . $phone . "' where address_id = " . $addyResult->address_id;
		
		
		if(!mysqli_query($link, $query))
			die("Query failed");
	}	
		
}
	


$timestamp = mktime(0, 0, 0, (int)$_POST["months"], (int)$_POST["days"], (int)$_POST["year"]);	
$date = date("Y-m-d", $timestamp);
	
$sql = "INSERT INTO loans (loan_id, inventory_id, borrower_id, issue_date, return_date, starting_condition) VALUES (NULL, " . $inventory_id . ", " . $user_id . ", '" . $date . "', NULL, '" . $item->current_condition . "'	)";	

	
if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: viewinventory.php');
	
?>