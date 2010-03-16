<?php

/*

    Copyright (C) 2010, All Rights Reserved.

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


require_once('lib/auth.lib.php');  //Session
require_once('lib/fields.lib.php');
require_once('class/database.class.php');

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	
if ($auth < 2)
{
	die("You dont have permission to access this page");
}

// Ensure a field was given
if (!isset($_GET['id']))
{
    die('No custom field was specified');
}

if (!isset($_SESSION['club']))
{
    die('Club not set!');
}

// Cast to int for security
$clubId = (int)$_SESSION['club'];

// Cast to int for security
$fieldId = (int)$_GET['id'];

// Delete the custom field and data
deleteCustomField($fieldId, $clubId, $db);

// Close the db
$db->close();

// Bounce back to manage custom fields page
header('Location: manageCustomFields.php');

?>
