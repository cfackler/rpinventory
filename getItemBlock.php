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

require_once('modules/json/JSON.php');
require_once("lib/connect.lib.php");  //mysql
require_once("lib/auth.lib.php");   //Session
require_once('lib/locations.lib.php'); //getting locations drop down items
require_once('lib/display.lib.php');

//Authenticate
$auth = GetAuthority();
if($auth < 1)
  die("You dont have permission to access this page");


//GET ID
$id = (int)$_GET['id'];
if($id == 0)
  die("Invalid ID");

$location_options = getLocationsOptions();
$category_options = get_options('categories', 'id', 'category_name');

echo <<<END
<table>
<tr>
<td>Item Description: </td>
<td><input type="text" name="desc-$id" size="40" id="description-$id" class="validate"></td>
  </tr>
	  
  <tr>
  <td>Value: </td>
  <td><input type="text" name="value-$id" id="value-$id" class="value validate" onchange="updateTotal('value-$id')"/></td>
  </tr>
	
	<tr>
		<td>Category: </td>
		<td>
			<input type="hidden" id="category_count-$id" name="category_count-$id" value="1">

				<select multiple="multiple" id="category-$id" name="category-{$id}[]" class="category_select" title="Please select a category">
					$category_options
				</select>
		</td>
		<td>
			<span id="category_notification-$id" name="category_notification-$id" class="notification"><a id="add_category_button-$id" class="ui-state-default ui-corner-all icon_button add_category_button">
				<span class="ui-icon ui-icon-plus icon_button_icon"><!-- --></span>Add Category
			</a></span>
		</td>
	</tr>
	
  <tr>
  <td>Condition: </td>
  <td>
  <select class="dropDown" name="condition-$id" id="condition-$id">
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
    <select id="location-$id" name="location-$id" class="location_select">

			{$location_options}

    </select>
  </td>

	<td>
		<span id="location_notification-$id">
			<a id="add_location_button-$id" class="ui-state-default ui-corner-all icon_button add_location_button">
				<span class="ui-icon ui-icon-plus icon_button_icon"><!-- --></span>Add Location
			</a>
		</span>
	</td>

  </tr>

  </table>
END;

?>
