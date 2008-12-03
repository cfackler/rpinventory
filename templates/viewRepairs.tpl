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

{if $authority>1}
    <table width="800" border="0" class="itemsTable" cellspacing="0">
    	<tr>		
		<th width="200">Item</th>
		<th>Company Name</th>
		<th>Date</th>
		<th>Cost</th>
		<th width="250">Description</th>
	</tr>

    {section name=itemLoop loop=$items}
    <tr{cycle values=" class=\"alt\","}>

	<td>{$items[itemLoop]->inv_description}</td>
	<td><a href="viewAddress.php?id={$items[itemLoop]->business_id}">{$items[itemLoop]->company_name}</td>
	<td>{$items[itemLoop]->repair_date}</td>
	<td>${$items[itemLoop]->repair_cost}</td>
	<td>{$items[itemLoop]->rep_description}</td>
    </tr>
    {/section}	


    </table>
{else}
    <h3>Repairs</h3>

    <p>Please login if you wish to view information about repairs.</p>
{/if}