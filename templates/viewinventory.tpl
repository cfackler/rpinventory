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
    along with Foobar.  If not, see <http://www.gnu.org/licenses/>.

*}

{if $authority >= 1}
<a href="addinventory.php">Add Inventory</a>
<br>
<br>
{/if}

<form id="itemList" name="itemList">

<table width="800" border="0" class="itemsTable" cellspacing="0" >
	<tr>
		{if $authority >= 1}
			<th width="20"> </th>
		{/if}
		<th width="250">Item</th>
		<th width="100">Condition</th>
		<th>Value</th>
		<th>Location</th>
	</tr>

{section name=itemLoop loop=$items}
<tr{cycle values=" class=\"alt\","}>
	{if $authority >= 1}
		<td><input type="checkbox" name="{$items[itemLoop]->inventory_id}" id="{$items[itemLoop]->inventory_id}"></td>
	{/if}
	<td>{$items[itemLoop]->description}</td>
	<td>{$items[itemLoop]->current_condition}</td>
	<td>{$items[itemLoop]->current_value}</td>
	<td align="center">{$items[itemLoop]->location}</td>
</tr>
{/section}	


</table>
<br>

{if $authority >= 1}
	
<select name="action_list" id="action_list">

<option value="Loan">Loan</option>
<option value="Edit">Edit</option>
<option value="Repair">Repair</option>
<option value="Delete">Delete</option>
</select>


<input type="button" onclick="submitItems()" value="Go">
{/if}

</form>