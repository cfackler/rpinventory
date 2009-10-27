<?php

/*

    Copyright (C) 2009, All Rights Reserved.

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
$ignoreBusiness = false;
if( isset( $_POST['ignoreBusiness'] ) ){
  $ignoreBusiness = true;
}

if( !$ignoreBusiness ){
  $bus_id = $_POST['business_id'];
  
  $sql = "SELECT business_id FROM businesses";
  
  $result = mysqli_query($link, $sql);
  $numBusinesses = mysqli_num_rows($result);
  
  // Chose to insert a new business
  if($bus_id == 'newBusiness'){
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

    /* Sanitize */
    $company = mysqli_real_escape_string( $link, $company );
    $address = mysqli_real_escape_string( $link, $address );
    $address2 = mysqli_real_escape_string( $link, $address2 );
    $city = mysqli_real_escape_string( $link, $city );
    $state = mysqli_real_escape_string( $link, $state );
    $zip = mysqli_real_escape_string( $link, $zip );
    $phone = mysqli_real_escape_string( $link, $phone );
    $fax = mysqli_real_escape_string( $link, $fax );
    $email = mysqli_real_escape_string( $link, $email );
    $website = mysqli_real_escape_string( $link, $website );
      
    
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
}

/* Amount of items to insert for this purchase */
$count = (int)$_POST['count'];
if($count == 0)
	die("invalid count");

//Date
$timestamp = mktime(0, 0, 0, (int)$_POST["Date_Month"], (int)$_POST["Date_Day"], (int)$_POST["Date_Year"]);	
$date = date("Y-m-d", $timestamp);


//Total cost
$total_cost = (double)$_POST['total_cost'];	


//Insert purchase
$sql;

if( $ignoreBusiness ) {
  $sql = "INSERT INTO purchases (purchase_id, business_id, purchase_date, total_price) VALUES
	(NULL, " . -1 . ", '" . $date . "', " . -1 . ")";
}
else{
  $sql = "INSERT INTO purchases (purchase_id, business_id, purchase_date, total_price) VALUES
	(NULL, " . $bus_id . ", '" . $date . "', " . $total_cost . ")";
}

if(!mysqli_query($link, $sql))
  die("Query failed");
	
//ID
$purchase_id = mysqli_insert_id($link);
	
//All items
for($x=0; $x<$count; $x++)
{
  //Description
  $itemdesc = $_POST["desc-".$x];
  if(strlen($itemdesc) == 0)
    die("Must have a description");

  //Condition
  $condition = $_POST["condition-".$x];
  if(strlen($condition) == 0)
    die("Must have a condition");	
  
  //Value
  $valueStr = $_POST["value-".$x];
  $value = (double)$_POST["value-".$x];
  if(strlen($valueStr) == 0)
    die("Must have a value");
  
  //Location	
  $location = (int)$_POST["location-" . $x];
  
  $itemdesc = mysqli_real_escape_string( $link, $itemdesc );
  $condition = mysqli_real_escape_string( $link, $condition );
  $valueStr = mysqli_real_escape_string( $link, $valueStr ); 
  
  //Insert new inventory item
  $sql = "INSERT INTO inventory (inventory_id, description, location_id, current_condition, current_value) VALUES (NULL, '" . $itemdesc . "', " . $location . ", '" . $condition . "', " . $value . ")";		
  
  if(!mysqli_query($link, $sql))
    die("Inventory Insert Query failed");
  
  $inv_id = mysqli_insert_id($link);
  
  
  //Insert purchase record for new inventory item
  $sql = "INSERT INTO purchase_items (purchase_id, inventory_id, cost) VALUES
	(" . $purchase_id .", " . $inv_id .", " . $value .")";
  
  if(!mysqli_query($link, $sql))
    die("Purchase Record Query failed");

	// For all categories
	$sql = '';
	$categories = $_POST['category-'.$x];
	if(sizeof($categories) > 0)
	{
		for($c = 0; $c < sizeof($categories); $c++)
		{
			//Insert item category
			$sql .= 'INSERT INTO inventory_category (inventory_id, category_id) VALUES ('.$inv_id.', '.$categories[$c].');'	;
		}
		mysqli_multi_query($link, $sql) or die('Error inserting item categories: '.mysqli_error($link));
	}
	
	
}
	

mysqli_close($link);
header('Location: viewPurchases.php');
	
?>
