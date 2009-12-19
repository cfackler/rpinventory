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

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
  die("You dont have permission to access this page");

$db = new database();
	
//grab all ids
$token = strtok($_GET['ids'], ",");
$idList = array();

while ($token !== false)
{
    $idList[] = (int)$token;
    $token = strtok(",");
}

//Run delete
foreach ($idList as $id)
{
    //Remove item
    $sql = 'DELETE FROM inventory WHERE inventory_id = ?';

    //Run update
    $db->query($sql, $id);
		
    //Remove any loan records
    $sql = 'DELETE FROM loans WHERE inventory_id = ?';

    //Run update
    $db->query($sql, $id);
}

$db->close();

header('Location: viewInventory.php');
	
?>
