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
		<a href="addBorrower.php">Add new borrower</a>
	</span>
</div>
<div id="filters" class="filters">
	<h3>Search:</h3>
		<input type="text" id="searchField" class="searchField" />	
</div>

<table width="800" border="0" class="itemsTable searchable sortable" cellspacing="0">
	<thead>
		<tr>
			<th width="150">Name</th>
			<th width="100">RIN</th>
			<th width="150">Email</th>
			<th width="100">Address</th>		
			<th width="200">Actions</th>
		</tr>
	</thead>
	<tbody>
		{section name=borrowerLoop loop=$borrowers}
		<tr{cycle values=" class=\"alt\","}>
			<td align="center">{$borrowers[borrowerLoop]->name}</td>
			<td align="center">{$borrowers[borrowerLoop]->rin}</td>
			<td align="center"><a href="mailto:{$borrowers[borrowerLoop]->email}">{$borrowers[borrowerLoop]->email}</a></td>
			<td align="center"><a href="viewBorrowerAddress.php?id={$borrowers[borrowerLoop]->borrower_id}">Address</a></td>
	
			<td align="center"><a href="editBorrower.php?id={$borrowers[borrowerLoop]->borrower_id}">Edit</a> or <input type="button" class="button" onclick="confirmation('Are you sure you want to delete borrower \'{$borrowers[borrowerLoop]->name}\'?','deleteBorrower.php?id={$borrowers[borrowerLoop]->borrower_id}')" value="Delete Borrower"></td>
		</tr>
		{/section}	
	</tbody>
</table>
