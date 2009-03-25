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

require_once('modules/json/JSON.php');
require_once("lib/connect.lib.php");  //mysql
require_once("lib/auth.lib.php");   //Session

//Authenticate
$auth = GetAuthority();
if($auth < 1)
  die("You dont have permission to access this page");

$link = connect();
if($link == null)
  die("Database connection failed");

//GET ID
$id = (int)$_GET['id'];
if($id == 0)
  die("Invalid ID");

// Generate locations select
$sql = "SELECT location_id, location FROM locations";
$result = mysqli_query($link, $sql);
$locations = array();

while($loc = mysqli_fetch_object($result))
  $locations [] = $loc;

$loc_select = "";
foreach($locations as $location) {
  $loc_select .= '<option value="' . $location->location_id . '">';
  $loc_select .= $location->location . "</option>\n";
}

echo <<<END
<table>
<tr>
<td>Item Description: </td>
<td><input type="text" name="desc$id" size="40" id="description$id" class="validate"></td>
  </tr>
	  
  <tr>
  <td>Value: </td>
  <td><input type="text" name="value$id" id="value$id" class="validate"></td>
  </tr>
	  
  <tr>
  <td>Condition: </td>
  <td>
  <select name="condition$id">
  <option value="Excellent">Excellent</option>
  <option value="Good">Good</option>
  <option value="Fair">Fair</option>
  <option value="Poor">Poor</option>
  </select>
  </td>
  </tr>

  <tr>
  <td>Location: </td>

  <td>
  <select id="location$id" name="location$id" onChange="OnChangeDouble('location$id', 'newLocation$id', 'newDescription$id')">
  $loc_select
  <option>
  New Location
  </option>
  </select>

  </td>
  </tr>

  <tr id="newLocation$id" style="display:none">
  <td>New Location:</td>
  <td>
  <input type="text" name="newlocation$id" id="newlocation$id" size="40">
  </td>
  </tr>
  <tr id="newDescription$id" style="display:none">
  <td>Location Description:</td>
  <td>
  <input type="text" name="newdescription$id" size="40">
  </td>
  </tr>
  </table>
END;

?>