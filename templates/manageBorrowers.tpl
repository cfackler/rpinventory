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

<table width="700" border="0" class="itemsTable" cellspacing="0">
	<tr>
		
    {* Table header *}
    {generateTableHeader headers=$headers currentSortIndex=$currentSortIndex currentSortDir=$currentSortDir}
		{* Actions does not need to be a sorting column *}
		<th width="150">Actions</th>
		
	</tr>

{section name=borrowerLoop loop=$borrowers}
<tr{cycle values=" class=\"alt\","}>
	<td align="center">{$borrowers[borrowerLoop]->name}</td>
	<td align="center">{$borrowers[borrowerLoop]->rin}</td>
	<td align="center"><a href="mailto:{$borrowers[borrowerLoop]->email}">{$borrowers[borrowerLoop]->email}</a></td>
	
	<td align="center"><a href="editUser.php?id={$borrowers[borrowerLoop]->id}">Edit</a> or <input type="button" class="button" onclick="confirmation('Are you sure you want to delete user {$borrowers[borrowerLoop]->username} ?','deleteUser.php?id={$borrowers[borrowerLoop]->id}')" value="Delete User"></td>
</tr>
{/section}	


</table>

{if $displayPaginate }
	<br />
	<div id="paginate">{paginate_prev} {paginate_middle} {paginate_next}</div>
{/if}
