<?php

/*

    Copyright (C) 2008, All Rights Reserved.

    This file is part of RPInventory.

    RPInventory is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    RPInventory is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with RPInventory.  If not, see <http://www.gnu.org/licenses/>.

*/

require_once("lib/connect.lib.php");  //mysql
require_once("lib/auth.lib.php");  //Session

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
	die("You dont have permission to access this page");
	
// Business
$bus_id = (int)$_POST["business_id"];

$sql = "SELECT business_id FROM businesses";

$result = mysqli_query($link, $sql);
$numBusinesses = mysqli_num_rows($result);

// Chose to insert a new business
if($bus_id>$numBusinesses){
        //Company name
        $company = $_POST["company"];
	if(strlen($company) == 0)
	  die("Must have a company name");
	
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
	
	//Insert the business address
	$query = "insert into addresses (address_id, address, address2, city, state, zipcode, phone) VALUES(NULL, '" . $address . "', '" . $address2 . "', '" . $city . "', '" . $state . "', '" . $zip . "', '" . $phone . "')";
		
	if(!mysqli_query($link, $query))
	  die("Query failed first");
	$address_id = mysqli_insert_id($link);

	//Inser the business
	$sql = "INSERT INTO businesses (business_id, address_id, company_name, fax, email, website) VALUES (NULL, '" . $address_id . "' , '" . $company . "', '" . $fax . "', '" . $email . "', '" . $website . "')";

	if(!mysqli_query($link, $sql))
	  die("Query failed business insert");

	// Get the ID of the new business
	$bus_id = mysqli_insert_id($link);
}//Incorrect business was selected
elseif($bus_id == 0){
	die("Invalid Business was chosen");
}
elseif(!VerifyBusinessExists($bus_id, $link)){
	die("Invalid Business");
}

$count = (int)$_POST['count'];
if($count == 0)
	die("invalid count");

//Date
$timestamp = mktime(0, 0, 0, (int)$_POST["months"], (int)$_POST["days"], (int)$_POST["year"]);	
$date = date("Y-m-d", $timestamp);


//Total cost
$cost = $_POST['total_cost'];	

//echo $bus_id."<br />";

	
//Insert purchase
$sql = "INSERT INTO purchases (purchase_id, business_id, purchase_date, total_price) VALUES
	(NULL, " . $bus_id . ", '" . $date . "', '" . $cost . "')";

//echo $sql . "<br>";
		
if(!mysqli_query($link, $sql))
	die("Query failed");
	
//ID
$purchase_id = mysqli_insert_id($link);
	
//All items
for($x=0; $x<$count; $x++)
{
  //  echo $x."<br />";
	//Description
	$itemdesc = $_POST["desc".$x];
	if(strlen($itemdesc) == 0)
	  die("Must have a description");
	
	//Condition
	$condition = $_POST["condition".$x];
	if(strlen($condition) == 0)
	  die("Must have a condition");	
	
	//Value
	$value = (double)$_POST["value".$x];
	if($value == 0)
	  die("Invalid Value");
	
	//Location	
	$location = (int)$_POST["location" . $x];
	
	//Check location exists
	$result=mysqli_query($link, "select * from locations where location_id=" . $location);
	$checkRows = mysqli_num_rows($result);
	
	//if not in database, new location was specified
	if($checkRows == 0){
		
	  $newLocation = $_POST["newlocation" . $x];
	  if(strlen($newLocation) == 0)
		die("New location must have a name.");	
	  $locDescription = $_POST["newdescription" . $x];
	  if(strlen($locDescription) == 0)
		die("New location must have a description.");	
	  
	  $sql = "INSERT INTO locations (location_id, location, description) VALUES (NULL, '" . $newLocation . "', '" . $locDescription . "')";
	  
	  if(!mysqli_query($link, $sql))
	  	die("New Location Insert Query Failed");
	
	  $location = mysqli_insert_id($link);  
		
	  if($location == 0)
		die("Must have a location");
	}
	//stuff they entered already exists in the table
	else if($checkRows == 1){
	  $loc = mysqli_fetch_object($result);
	  $location = $loc->location_id;
	}
	else
	  die("Cannot determine correct location_id from given name. Location already exists with name: ".$newLocation);
	
	
	//Insert new inventory item
	$sql = "INSERT INTO inventory (inventory_id, description, location_id, current_condition, current_value) VALUES (NULL, '" . $itemdesc . "', " . $location . ", '" . $condition . "', " . $value . ")";		
	
	//	echo $sql."<br />";

	if(!mysqli_query($link, $sql))
	  die("Query failed");
	
	$inv_id = mysqli_insert_id($link);
		
		
	//Insert purchase record for new inventory item
	$sql = "INSERT INTO purchase_items (purchase_id, inventory_id, cost) VALUES
	(" . $purchase_id .", " . $inv_id .", " . $cost .")";
	
	//	echo $sql . "<br>";
	
	
	if(!mysqli_query($link, $sql))
		die("Query failed");
}
	

mysqli_close($link);
header('Location: viewPurchases.php');
	
?>
