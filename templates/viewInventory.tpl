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


<form id="itemList" name="itemList">

<div id="filters" class="filters">
	<h3>Search:</h3>
		<input type="text" id="searchField" class="searchField" />	
</div>

<table width="800" border="0" id="itemsTable" class="itemsTable" cellspacing="0" >
	<thead>
		<tr>
			{if $authority >= 1}
				<th width="20"> </th>
			{/if}
	    <th width="250">Item</th>
			<th width="100">Category</th>
			{if $authority >= 1}
				<th width="100">Condition</th>
				<th width="150">Current Value</th>
			{/if}
			<th width="150">Location</th>
	  </tr>
	</thead>
	<tbody>
		{section name=itemLoop loop=$items}
		<tr{cycle values=" class=\"alt\","}>
			{if $authority >= 1}
				<td><input type="checkbox" name="{$items[itemLoop]->inventory_id}" id="{$items[itemLoop]->inventory_id}"></td>
			{/if}
			<td>{$items[itemLoop]->description}</td>
			<td>{$items[itemLoop]->category}</td>
			{if $authority >= 1}
				<td>{$items[itemLoop]->current_condition}</td>
				<td>${$items[itemLoop]->current_value}</td>
			{/if}
			{if $items[itemLoop]->loan_id == 0 && $items[itemLoop]->checkout_id == 0}
				<td align="center">{$items[itemLoop]->location}</td>
			{elseif $items[itemLoop]->checkout_id == 0}
				<td align="center"><a href="viewLoans.php?loanId={$items[itemLoop]->loan_id}">{$items[itemLoop]->location}</a></td>
		    {else}
		        <td align="center"><a href="viewCheckouts.php?checkoutId={$items[itemLoop]->checkout_id}">{$items[itemLoop]->location}</a></td>
			{/if}
		</tr>
		{/section}	
	</tbody>

</table>
<br />

<div>

{if $authority >= 1}
	
<span id="inventoryActions">
<select class="dropDown" name="action_list" id="action_list">
	<option value="Loan">Loan</option>
	<option value="Checkout">Checkout</option>
	<option value="Edit">Edit</option>
	<option value="Repair">Repair</option>
	<option value="Delete">Delete</option>

</select>

<input type="button" class="button" onclick="submitItems()" value="Go">
</span>
</div>
{/if}

</form>

{if $authority >= 1}

<br />
<br />

{/if}

<a href="makeInventorySummary.php"><img border="0" src="images/pdficon_small.gif" />&nbsp;&nbsp;Download PDF</a>

