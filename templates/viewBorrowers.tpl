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

<h3>Borrowers</h3>

{if $authority >= 1}
    <table width="800" border="0" cellspacing="0" class="itemsTable">
    	<tr>
		<th width="150">Name</th>
		<th width="100">RIN</th>
		<th width="150">Email</th>
		<th>Address</th>
		<th width="100">Phone</th>
	</tr>

	{section name=num loop=$borrowers}
	<tr{cycle values=" class=\"alt\","}>
		<td align="center">{$borrowers[num]->name}</td>
		<td align="center">{$borrowers[num]->rin}</td>
		<td align="center">{$borrowers[num]->email}</td>
		
		<td align="center">
			{$borrowers[num]->address}<br>
			
			{if $borrowers[num]->address2 != NULL}
			{$borrowers[num]->address2}<br>
			{/if}
			
			{$borrowers[num]->city}, {$borrowers[num]->state} {$borrowers[num]->zipcode}<br>
		</td>
		
		<td align="center">{$borrowers[num]->phone}</td>
		
	</tr>
	{/section}
    </table>
{else}
    <p>Please login if you wish to view information about borrowers</p>
{/if}