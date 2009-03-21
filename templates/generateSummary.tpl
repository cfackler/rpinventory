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


<form name="makeSummary" action="makeSummary.php" METHOD="post">


<h3>Select Items to be Included</h3>

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
		<input type="checkbox" name="users" value="Users" />
		<label for="users">Users</label>
	</li>
	<li>
		<input type="checkbox" name="locations" value="Locations" />
		<label for="locations">Locations</label>
	</li>
</ul>

<br />

<input type="submit" value="Create Summary">

</form>
