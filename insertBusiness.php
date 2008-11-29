<?php
require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //Session

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();	

if($auth<1)
	die("Please login to complete this action");

//Company name
$company = $_POST["company"];
if(strlen($company) == 0)
	die("Must have a name");
	
//Address
$address = $_POST["address"];
if(strlen($address) == 0)
	die("Must have an address");

$address2 = $_POST["address2"];

//City
$city = $_POST["city"];
if(strlen($city) == 0)
	die("Must have a city");

//State
$state = $_POST["state"];
if(strlen($state) == 0)
	die("Must have a state");

//Zip Code
$zip = $_POST["zip"];
if(strlen($zip) == 0)
	die("Must have a zip code");

//Contact info
$phone = $_POST["phone"];
$fax = $_POST["fax"];
$email = $_POST["email"];
if(strlen($phone) == 0 && strlen($fax) == 0 && strlen($email) == 0)
	die("Must have contact information");

$website = $_POST["website"];

$query = "insert into addresses (address_id, address, address2, city, state, zipcode, phone) VALUES(NULL, '" . $address . "', '" . $address2 . "', '" . $city . "', '" . $state . "', '" . $zip . "', '" . $phone . "')";
		
if(!mysqli_query($link, $query))
	die("Query failed");
$address_id = mysqli_insert_id($link);

$sql = "INSERT INTO businesses (business_id, address_id, company name, fax, email, website) VALUES (NULL, '" . $address_id . "' , '" . $company . "', '" . $fax . "', '" . $email . "', '" . $website . "')";

	
if(!mysqli_query($link, $sql))
	die("Query failed");

mysqli_close($link);
header('Location: manageLocations.php');
	
?>
