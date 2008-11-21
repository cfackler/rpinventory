<?php

include_once('JSON.php');
require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");   //Session

$link = connect();
if($link == null)
	die("Database connection failed");
	
//Authenticate
$auth = GetAuthority();
if($auth < 1)
	die("You dont have permission to access this page");
	
	
//JSON data 
$data = array("Found" => 'False', "Address" => '', "Address2" => '', "City" => '', "State" => '', "Zipcode" => '', "Phone" => '');
	

//GET ID
$id = (int)$_GET['id'];
if($id == 0)
	die("Invalid ID");	
	
//Address
$query= "SELECT *  FROM addresses, borrower_addresses WHERE addresses.address_id = borrower_addresses.address_id and borrower_addresses.user_id = " . $id;
$result = mysqli_query($link, $query);

if(mysqli_num_rows($result) != 0)
{
	$item = mysqli_fetch_object($result);
	$data["Found"] = 'True';
	
	if($item->address != NULL)
		$data["Address"] = $item->address;
		
	if($item->address2 != NULL)
		$data["Address2"] = $item->address2;
		
	if($item->city != NULL)
		$data["City"] = $item->city;
		
	if($item->state != NULL)
		$data["State"] = $item->state;
		
	if($item->zipcode != NULL)
		$data["Zipcode"] = $item->zipcode;
		
	if($item->phone != NULL)
		$data["Phone"] = $item->phone;
	

}

	

$json = new Services_JSON(); 


header('X-JSON: ('.$json->encode($data).')');

//echo $json->encode($data);

//print_r($data);

?>