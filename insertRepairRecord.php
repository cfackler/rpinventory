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


//Get item count
$count = (int)$_POST["count"];
if($count == 0)
	die("Must repair at least one item");


//Create loan records
for($x=0; $x<$count; $x++)
{
  //Date
  $timestamp = mktime(0, 0, 0, (int)$_POST["months" . $x], (int)$_POST["days" . $x], (int)$_POST["year" . $x]);	
  $date = date("Y-m-d", $timestamp);
  
  //Description
  $desc = $_POST["desc" . $x];
  if(strlen($desc) == 0)
    die("Must have a description");
  
  //Item ID
  $inventory_id = (int)$_POST["inventory_id" . $x];
  if($inventory_id == 0)
    die("Invalid item id");	
  
  //cost
  $cost = (double)$_POST["cost" . $x];
  if($cost == 0)
    die("Invalid Cost");
  
  //Biz id
  $businessId = (int)$_POST["businessId" . $x];

  /* Sanitize */
  $desc = mysqli_real_escape_string( $link, $desc );
  
  // Chose to insert a new business
  if($businessId == -1)
    {
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
      
      // Add correct 'http://' at beginning on URL 
      $website = preg_replace('/^(http:\/\/)*(.+)$/i', 'http://$2', $website); 
      
      // Clean user input
      $address = mysqli_real_escape_string($link, $address);
      $address2 = mysqli_real_escape_string($link, $address2);
      $city = mysqli_real_escape_string($link, $city);
      $state = mysqli_real_escape_string($link, $state);
      $zip = mysqli_real_escape_string($link, $zip);
      $phone = mysqli_real_escape_string($link, $phone);
      $company = mysqli_real_escape_string($link, $company);
      $fax = mysqli_real_escape_string($link, $fax);
      $email = mysqli_real_escape_string($link, $email);
      $website = mysqli_real_escape_string($link, $website);
      
      $company = trim($company);

      //Insert the business address
      $query = "insert into addresses (address_id, address, address2, city, state, zipcode, phone) VALUES(NULL, '" . $address . "', '" . $address2 . "', '" . $city . "', '" . 				$state . "', '" . $zip . "', '" . $phone . "')";
      
      if(!mysqli_query($link, $query))
	die("Query failed first");
      $address_id = mysqli_insert_id($link);
      
      //Insert the business
      $sql = "INSERT INTO businesses (business_id, address_id, company_name, fax, email, website) VALUES (NULL, '" . $address_id . "' , '" . $company . "', '" . $fax . "', '" . $email . "', '" . $website . "')";
      
      if(!mysqli_query($link, $sql))
	die("Query failed business insert");
      
      // Get the ID of the new business
      $businessId = mysqli_insert_id($link);
    }
  elseif($businessId == 0)
    {
      die("Invalid Business id");
    }
  elseif(!VerifyBusinessExists($businessId, $link))
    {
      die("Invalid Business");
    }
  
  
  
  //insert repair
  $sql = "INSERT INTO repairs (repair_id, inventory_id, business_id, repair_date, repair_cost, description) VALUES
	(NULL, " . $inventory_id . ", " . $businessId . ", '" . $date . "', " . $cost . ", '" . $desc . "'	)";
  
  if(!mysqli_query($link, $sql))
    die("Query failed");
  
}

mysqli_close($link);
header('Location: viewInventory.php');
	
?>