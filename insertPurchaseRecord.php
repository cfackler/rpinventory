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

require_once('class/database.class.php');  //mysql
require_once("lib/auth.lib.php");  //Session

$db = new database();

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
	die("You dont have permission to access this page");
	
// Business
$ignoreBusiness = false;
if (isset($_POST['ignoreBusiness']))
{
    $ignoreBusiness = true;
}

if (!$ignoreBusiness)
{
    $bus_id = $_POST['business_id'];

    $sql = "SELECT business_id FROM businesses";

    $result = $db->query($sql);
    $numBusinesses = mysqli_num_rows($result);

    // Chose to insert a new business
    if ($bus_id == 'newBusiness')
    {
        //Company name
        $company = $_POST["company"];
        if (strlen($company) == 0)
        {
            die("Must have a company name");
        }

        //Address
        $address = $_POST["address"];
        if (strlen($address) == 0)
        {
            die("Must have an address");
        }

        $address2 = $_POST["address2"];

        //City
        $city = $_POST["city"];
        if (strlen($city) == 0)
        {
            die("Must have a city");
        }

        //State
        $state = $_POST["state"];
        if (strlen($state) == 0)
        {
            die("Must have a state");
        }
    
        //Zip Code
        $zip = $_POST["zip"];
        if (strlen($zip) == 0)
        {
            die("Must have a zip code");
        }
    
        //Contact info
        $phone = $_POST["phone"];
        $fax = $_POST["fax"];
        $email = $_POST["email"];
        if (strlen($phone) == 0 && strlen($fax) == 0 && strlen($email) == 0)
        {
            die("Must have contact information");
        }

        $website = $_POST["website"];

        //Insert the business address
        $query = 'INSERT INTO addresses (address_id, address, address2, city, state, zipcode, phone) VALUES(NULL, ?, ?, ?, ?, ?, ?)';

        $db->query($query, $address, $address2, $city, $state, $zip, $phone);

        $address_id = $db->insertId();

        //Inser the business
        $sql = 'INSERT INTO businesses (business_id, address_id, company_name, fax, email, website) VALUES (NULL, ?, ?, ?, ?, ?)';

        $db->query($sql, $address_id, $company, $fax, $email, $website);

        // Get the ID of the new business
        $bus_id = $db->insertId();
    } //Incorrect business was selected
    elseif ($bus_id == 0)
    {
        die("Invalid Business was chosen");
    }
    elseif (!VerifyBusinessExists($bus_id, $db))
    {
        die("Invalid Business");
    }
}

/* Amount of items to insert for this purchase */
$count = (int)$_POST['count'];
if ($count == 0)
{
    die("invalid count");
}

//Date
$timestamp = mktime(0, 0, 0, (int)$_POST["Date_Month"], (int)$_POST["Date_Day"], (int)$_POST["Date_Year"]);	
$date = date("Y-m-d", $timestamp);


//Total cost
$total_cost = (double)$_POST['total_cost'];	


//Insert purchase
$sql = 'INSERT INTO purchases (purchase_id, business_id, purchase_date, total_price) VALUES	(NULL, ?, ?, ?)';

if ($ignoreBusiness)
{
    $db->query($sql, -1, $date, -1);
}
else
{
    $db->query($sql, $bus_id, $date, $total_cost);
}


//ID
$purchase_id = $db->insertId();
	
//All items
for ($x=0; $x<$count; $x++)
{
    //Description
    $itemdesc = $_POST["desc-".$x];
    if (strlen($itemdesc) == 0)
    {
        die("Must have a description");
    }

    //Condition
    $condition = $_POST["condition-".$x];
    if (strlen($condition) == 0)
    {
        die("Must have a condition");
    }
  
    //Value
    $valueStr = $_POST["value-".$x];
    $value = (double)$_POST["value-".$x];
    if (strlen($valueStr) == 0)
    {
        die("Must have a value");
    }
  
    //Location	
    $location = (int)$_POST["location-" . $x];

    $club_id = $_SESSION['club'];
  
    //Insert new inventory item
    $sql = 'INSERT INTO inventory (inventory_id, description, location_id, current_condition, current_value, club_id) VALUES (NULL, ?, ?, ?, ?, ?)';

    $db->query($sql, $itemdesc, $location, $condition, $value, $club_id);

    $inv_id = $db->insertId();

    //Insert purchase record for new inventory item
    $sql = 'INSERT INTO purchase_items (purchase_id, inventory_id, cost) VALUES (?, ?, ?)';

    $db->query($sql, $purchase_id, $inv_id, $value);

    // For all categories
	$categories = $_POST['category-'.$x];
	if (sizeof($categories) > 0)
	{
		for ($c = 0; $c < sizeof($categories); $c++)
		{
			//Insert item category
			$sql = 'INSERT INTO inventory_category (inventory_id, category_id) VALUES (?, ?)';
            $db->query($sql, $inv_id, $categories[$c]);
		}
	}
}
	
$db->close();

header('Location: viewPurchases.php');
	
?>
