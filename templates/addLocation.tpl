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

<form name="addLocation" action="insertLocation.php" METHOD="post">

<h3>Add Location</h3>

<table width="400">


<tr>
	<td>Location: </td>
	<td><input type="text" name="location" size="40"></td>
</tr>

<tr>
	<td>Description: </td>
	<td><textarea name="description" rows="6" cols="30"></textarea></td>
</tr>

</table>

<br>
<input type="submit" value="Add">

<form>
