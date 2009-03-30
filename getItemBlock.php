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
require_once('lib/locations.lib.php'); //getting locations drop down items

//Authenticate
$auth = GetAuthority();
if($auth < 1)
  die("You dont have permission to access this page");


//GET ID
$id = (int)$_GET['id'];
if($id == 0)
  die("Invalid ID");

$loc_select = getLocationsOptions( $id );

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
  <select id="location$id" name="location$id" onChange="OnChangeDouble('location$id', 'newLocation$id', 'newDescription$id')" onFocus="getLocationOptions(this);">
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
  <input type="text" name="newlocation$id" id="newlocation$id" size="40" onchange="sendValidateRequest('newlocation$id')">
  </td>
  </tr>
  <tr id="newDescription$id" style="display:none">
  <td>Location Description:</td>
  <td>
  <input type="text" name="newdescription$id" id="newdescription$id" size="40">
  </td>
  	    <td><input value="Save Location" type="button" onClick="saveLocation('newlocation$id', 'newdescription$id', 'resultText$id', 'location$id', 'newLocation$id', 'newDescription$id');">
	        <span id="resultText$id"></span>
	    </td>
  </tr>
  </table>
END;

?>