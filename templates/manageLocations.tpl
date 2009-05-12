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

<div class="TopOfTable"><span class="TopOfTable">
{*<h3>Locations</h3>*}
<a href="addLocation.php">Add new location</a>
</span></div>

<table width="700" border="0" cellspacing="0" class="itemsTable">
	<tr>
	   
       {* Table header *}
    {generateTableHeader headers=$headers currentSortIndex=$currentSortIndex currentSortDir=$currentSortDir}
		
		{* Actions do not need to be sorted. *}
		<th width="200">Actions</th>
	</tr>

{section name=num loop=$locations}
<tr{cycle values=" class=\"alt\","}>

	<td align="center">{$locations[num]->location}</td>
	<td align="center">{$locations[num]->description}</td>
	<td align="center">
	<a href="editLocation.php?id={$locations[num]->location_id}">Edit</a> or <input type="button" class="button" onclick="confirmation('Are you sure you want to delete location \'{$locations[num]->location}\' ?','deleteLocation.php?id={$locations[num]->location_id}')" value="Delete">
	</td>
</tr>
{/section}	


</table>

{if $displayPaginate }
	<br />
	<div id="paginate">{paginate_prev} {paginate_middle} {paginate_next}</div>
{/if}
