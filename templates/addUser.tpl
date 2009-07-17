{*
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

*}

<form name="storeTransaction" action="addUserRecord.php" onsubmit="return ValidateForm()" METHOD="post">
<span class="TopOfTable">
	<h3>Add User</h3>
</span>

<table width="400">

<tr>
	<td>Name: </td>
	<td><input type="text" name="name" size="40" id="name" class="validate"></td>
</tr>

<tr>
	<td>RIN: </td>
	<td><input type="text" name="rin" size="40" id="RIN" class="validate"></td>
</tr>

<tr>
	<td>Email: </td>
	<td><input type="text" name="email" size="40" id="email" class="validate"></td>
</tr>

<tr>
	<td>Username: </td>
	<td><input type="text" name="username" size="40" id="username" class="validate"></td>
</tr>

<tr>
	<td>Password:</td>
	<td><input type="password" name="password" size="40" id="password" class="validate"></td>
</tr>

<tr>
	<td>Permissions: </td>
	<td>
	<select class="dropDown" name="access_level">
		<option value="2">Administrator</option>
		<option value="1">Manager</option>
		<option value="0" selected>User</option>
	</select>	
	</td>
</tr>



</table>

<br>
<input type="submit" value="Add User">

<form>
