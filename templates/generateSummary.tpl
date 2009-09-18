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

<div class="TopOfTable">
<span class="TopOfTable">
     <h3>Select Items to be Included</h3>
</span>
</div>

<form name="makeSummary" id="checkBoxForm" action="makeSummary.php" onsubmit="return ValidateForm()" METHOD="post">

<ul class="nobullets">
	<li>
		<input type="checkbox" name="inventory" value="Inventory" />
		<label for="inventory">Inventory</label>
	</li>
	<li>
		<input type="checkbox" name="loans" value="Loans" />
		<label for="loans">Loans</label>
	</li>
	<li>
		<input type="checkbox" name="checkouts" value="Checkouts" />
		<label for="checkouts">Checkouts</label>
	</li>
	<li>
		<input type="checkbox" name="repairs" value="Repairs" />
		<label for="repairs">Repairs</label>
	</li>
	<li>
		<input type="checkbox" name="purchases" value="Purchases" />
		<label for="purchases">Purchases</label>
	</li>
	<li>
		<input type="checkbox" name="businesses" value="Businesses" />
		<label for="businesses">Businesses</label>
	</li>
    <li>
        <input type="checkbox" name="borrowers" value="Borrowers" />
        <label for="borrowers">Borrowers</label>
    </li>
	<li>
		<input type="checkbox" name="users" value="Users" />
		<label for="users">Users</label>
	</li>
	<li>
		<input type="checkbox" name="locations" value="Locations" />
		<label for="locations">Locations</label>
	</li>
	<br />
	<li class="indent">
		<input type="checkbox" name="selectallnone" value="selectallnone" onClick="selectAllNone(this, 'checkBoxForm');"/>
		<label for="selectallnone">Select All/None</label>
	</li>
</ul>
<br />
<table>
	<tr>
		<td><label for="startdate">Starting Date:</label> </td>
		<td>{html_select_date start_year="-5" end_year="+0"	class="dropDown"
            prefix="start_"}</td>
		
	</tr>
	<tr>
		<td><label for="enddate">Ending Date:</label></td>
		<td>{html_select_date start_year="-5" end_year="+0"	class="dropDown"
            prefix="end_"}</td>
	</tr>
</table>


<br />

<input type="submit" value="Create Summary">

</form>
