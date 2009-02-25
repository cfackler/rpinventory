{*
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

*}

<form name="addLocation" action="updateLocationRecord.php" onsubmit="return ValidateForm(this)" METHOD="post">

<h3>Edit Location</h3>

<table width="400">

<input type="hidden" id="location_id" name="location_id" value="{$location->location_id}">
<tr>
	<td>Location: </td>
	<td><input type="text" name="location_edit" size="40" value="{$location->location}" id="location_edit" class="validate" onchange="sendValidateRequest('location_edit')"></td>
</tr>

<tr>
	<td>Description: </td>
	<td><textarea name="description" rows="6" cols="30" id="location" class="validate">{$location->description}</textarea></td>
</tr>

</table>

<br>
<input type="submit" value="Edit">

<form>
