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
<div id="controlsTop" class="ui-widget-smaller ui-widget-content ui-corner-all controls">
	<div class="left">
		<h3>Search:</h3>
		<input type="text" id="searchField" class="searchField" />
	</div>
	<div class="right">
		<a id="addBorrower" class="ui-state-default ui-corner-all button" href="addBorrower.php">
			<span class="ui-icon ui-icon-circle-plus"><!-- --></span>
			<span class="buttonText">Add new borrower</span>
		</a>
	</div>
</div>

<table width="800" border="0" class="itemsTable sortable searchable ui-widget ui-corner-all" cellspacing="0">
	<thead class="ui-widget-header">
		<tr>
			<th width="150">Name</th>
			<th width="100">RIN</th>
			<th width="150">Email</th>
			<th width="100">Address</th>		
			<th width="200">Actions</th>
		</tr>
	</thead>
	<tbody class="ui-widget-content">
		{section name=borrowerLoop loop=$borrowers}
		<tr{cycle values=" class=\"alt\","}>
			<td align="center">{$borrowers[borrowerLoop]->name}</td>
			<td align="center">{$borrowers[borrowerLoop]->rin}</td>
			<td align="center"><a href="mailto:{$borrowers[borrowerLoop]->email}">{$borrowers[borrowerLoop]->email}</a></td>
			<td align="center">
                <a href="viewBorrowerAddress.php?id={$borrowers[borrowerLoop]->borrower_id}" class="ui-state-default ui-corner-all button">
                    <span class="ui-icon ui-icon-circle-arrow-e"></span>
                    <span class="buttonText">View Address</span>
                </a>
            </td>
	
			<td align="center">
                <a href="editBorrower.php?id={$borrowers[borrowerLoop]->borrower_id}" class="ui-state-default ui-corner-all button">
                    <span class="ui-icon ui-icon-circle-arrow-w"></span>
                    <span class="buttonText">Edit</span>
                </a>
                &nbsp;
                <input type="button" class="ui-state-default ui-corner-all button" onclick="confirmation('Are you sure you want to delete borrower \'{$borrowers[borrowerLoop]->name}\'?','deleteBorrower.php?id={$borrowers[borrowerLoop]->borrower_id}')" value="Delete" />
            </td>
		</tr>
		{/section}	
	</tbody>
</table>
