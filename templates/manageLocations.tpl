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
		<a id="addLocation" class="ui-state-default ui-corner-all button" href="addLocation.php">
			<span class="ui-icon ui-icon-circle-plus"><!-- --></span>
			<span class="buttonText">Add new location</span>
		</a>
	</div>
</div>

<table width="700" border="0" cellspacing="0" class="itemsTable sortable searchable ui-widget ui-corner-all">
	<thead class="ui-widget-header">
		<tr>
			<th width = "200">Location</th>
			<th width="300">Description</th>
			<th width="200">Actions</th>
		</tr>
	</thead>
	<tbody class="ui-widget-content">
		{section name=num loop=$locations}
		<tr{cycle values=" class=\"alt\","}>
			<td align="center">{$locations[num]->location}</td>
			<td align="center">{$locations[num]->description}</td>
			<td align="center">
			<a href="editLocation.php?id={$locations[num]->location_id}" class="ui-state-default ui-corner-all button">
                <span class="ui-icon ui-icon-circle-arrow-w"></span>
                <span class="buttonText">Edit</span>
            </a>
            &nbsp;
            <a class="ui-state-default ui-corner-all button" onclick="confirmation('Are you sure you want to delete location \'{$locations[num]->location}\' ?','deleteLocation.php?id={$locations[num]->location_id}')">
                <span class="ui-icon ui-icon-circle-close"></span>
                <span class="buttonText">Delete</span>
            </a>
			</td>
		</tr>
		{/section}
	</tbody>
</table>
