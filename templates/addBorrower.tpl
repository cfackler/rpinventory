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

<form name="storeTransaction" action="addBorrowerRecord.php" onsubmit="return ValidateForm()" METHOD="post">
<span class="TopOfTable">
	<h3>Add Borrower</h3>
</span>

<table width="400">

<tr>
	<td>Name: </td>
	<td><input type="text" name="name" size="40" id="name" class="validate"></td>
</tr>

<tr>
	<td>RIN:</td>
	<td><input type="text" name="RIN" size="40" id="RIN" class="validate"></td>
</tr>

<tr>
	<td>Email: </td>
	<td><input type="text" name="email" size="40" id="email" class="validate"></td>
</tr>

</table>

<br />
<input type="submit" value="Add Borrower" />

<form>
