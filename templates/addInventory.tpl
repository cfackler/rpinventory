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

<form name="addInventory" action="insertInventory.php" METHOD="post">

<h3>Add Item</h3>

<table width="400">


<tr>
	<td>Description: </td>
	<td><input type="text" name="desc" size="40"></td>
</tr>

<tr>
	<td>Value: </td>
	<td><input type="text" name="value" size="40"></td>
</tr>

<tr>
	<td>Condition: </td>
	<td>
		<select name="condition">
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
	
	<select name="location">
	{section name=loc loop=$locations}
		<option value="{$locations[loc]->location_id}">
			{$locations[loc]->location}
		</option>
	{/section}
	</select>
	
	</td>
</tr>

</table>

<br>
<input type="submit" value="Add Item">

</form>
