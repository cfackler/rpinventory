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

require_once("lib/auth.lib.php");  //Session
require_once('lib/inventory.lib.php');
require_once('lib/purchases.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
	die("You dont have permission to access this page");

if (!isset($_SESSION['club']))
{
    die('Need to have a club id');
}

$club_id = $_SESSION['club'];
	
// Business
$ignoreBusiness = false;
if (isset($_POST['ignoreBusiness']))
{
    $ignoreBusiness = true;
}

if (!$ignoreBusiness)
{
    require_once('lib/businesses.lib.php');
    require_once('lib/addresses.lib.php');

    $bus_id = $_POST['business_id'];

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
        $address_id = addAddress($address, $address2, $city, $state, $zip, $phone, $db);

        //Insert the business
        $bus_id = addBusiness($address_id, $company_name, $fax, $email, $website, $db);
    } //Incorrect business was selected
    elseif ($bus_id < 1)
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

$purchase_id = 0;

//Insert purchase
if ($ignoreBusiness)
{
    $purchase_id = addPurchase(-1, $date, -1, $db);
}
else
{
    $purchase_id = addPurchase($bus_id, $date, $total_cost, $db);
}
	
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

    //Insert new inventory item
    $inventory_id = addInventory($itemdesc, $location, $condition, $value, $db);

    //Insert purchase record for new inventory item
    $purchase_item_id = addPurchaseItem($purchase_id, $inventory_id, $value, $db);

    // For all categories
	$categories = $_POST['category-'.$x];
	if (sizeof($categories) > 0)
	{
		for ($c = 0; $c < sizeof($categories); $c++)
		{
			//Insert item category
            addInventoryCategory($inventory_id, $categories[$c], $db);
		}
	}
}

$db->close();
	
header('Location: viewPurchases.php');
	
?>
