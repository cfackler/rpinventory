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
		<a id="addClub" class="ui-state-default ui-corner-all button" href="addClub.php">
			<span class="ui-icon ui-icon-circle-plus"><!-- --></span>
			<span class="buttonText">Add new club</span>
		</a>
	</div>
</div>

<table width="700" border="0" class="itemsTable sortable searchable ui-widget ui-corner-all" cellspacing="0">
	<thead class="ui-widget-header">
		<tr>
			<th width="100">Club Name</th>
			<th width="300">Action</th>
		</tr>
	</thead>
	<tbody class="ui-widget-content">
		{section name=clubLoop loop=$clubs}
		<tr{cycle values=" class=\"alt\","}>
			<td align="center">{$clubs[clubLoop]->club_name}</td>
	
			<td align="center">
                <a href="editClub.php?id={$clubs[clubLoop]->club_id}" class="ui-state-default ui-corner-all button">
                    <span class="ui-icon ui-icon-circle-arrow-w"></span>
                    <span class="buttonText">Edit name</span>
                </a>
                &nbsp;
                <a href="addUserClub.php?id{$clubs[clubLoop]->club_id}" class="ui-state-default ui-corner-all button">
                    <span class="ui-icon ui-icon-circle-plus"></span>
                    <span class="buttonText">Add user to club</span>
                </a>
                &nbsp;
                <a class="ui-state-default ui-corner-all button" onclick="confirmation('Are you sure you want to delete club {$clubs[clubLoop]->club_name} ?','deleteClub.php?id={$clubs[clubLoop]->club_id}')">
                    <span class="ui-icon ui-icon-circle-close"></span>
                    <span class="buttonText">Delete club</span>
                </a>
            </td>
		</tr>
		{/section}	
	</tbody>
</table>
