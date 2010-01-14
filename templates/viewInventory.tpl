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


<form id="itemList" name="itemList" method="post" action="#">

<div id="controlsTop" class="ui-widget-smaller ui-widget-content ui-corner-all controls">
	<div class="left">
		<h3>Search:</h3>
		<input type="text" id="searchField" class="searchField" />
	</div>
    {if $authority >= 1}
	<div class="right">
		<a id="addPurchase" class="ui-state-default ui-corner-all button" href="addPurchase.php" title="Add to inventory">
			<span class="ui-icon ui-icon-circle-plus"><!-- --></span>
			<span class="buttonText">Insert inventory</span>
		</a>
	</div>
    {/if}
</div>
{if $authority >= 1}
<table width="800" id="itemsTable" class="itemsTable sortable searchable clickable ui-widget ui-corner-all" cellspacing="0" >
{else}
<table width="800" id="itemsTable" class="itemsTable sortable searchable ui-widget ui-corner-all" cellspacing="0" >
{/if}

	<thead class="ui-widget-header">
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
	<tbody class="ui-widget-content">
		{section name=itemLoop loop=$items}
		<tr{cycle values=" class=\"alt\","}>
			{if $authority >= 1}
				<td><input type="checkbox" name="{$items[itemLoop]->inventory_id}" id="item{$items[itemLoop]->inventory_id}" /></td>
			{/if}
			<td>{$items[itemLoop]->description}</td>
			<td>{$items[itemLoop]->category}</td>
			{if $authority >= 1}
				<td>{$items[itemLoop]->current_condition}</td>
				<td>${$items[itemLoop]->current_value}</td>
			{/if}
			{if $items[itemLoop]->loan_id == 0 && $items[itemLoop]->checkout_id == 0}
				<td>{$items[itemLoop]->location}</td>
			{elseif $items[itemLoop]->checkout_id == 0}
				<td><a href="viewLoans.php?loanId={$items[itemLoop]->loan_id}">{$items[itemLoop]->location}</a></td>
		    {else}
		        <td><a href="viewCheckouts.php?checkoutId={$items[itemLoop]->checkout_id}">{$items[itemLoop]->location}</a></td>
			{/if}
		</tr>
		{/section}	
	</tbody>

</table>
<br />

<div>

{if $authority >= 1}
<div id="controlsBottom" class="ui-widget-smaller ui-widget-content ui-corner-all controls">
  <div class="left">
    <h3>With checked:</h3>
    <select name="action_list" id="action_list">
    	<option value="Loan">Loan</option>
    	<option value="Checkout">Checkout</option>
    	<option value="Edit">Edit</option>
    	<option value="Repair">Repair</option>
    	<option value="Delete">Delete</option>

    </select>
    <a id="goButton" class="ui-state-default ui-corner-all button" href="#" onclick="submitItems()" title="Submit checked items">
      <span class="ui-icon ui-icon-circle-check"><!-- --></span>
    	<span class="buttonText">Go</span>
    </a>
  </div>
  <div class="right">
    <a id="pdfLink" class="ui-state-default ui-corner-all button" href="makeInventorySummary.php" title="Download summary of inventory">
			<span class="ui-icon ui-icon-circle-arrow-s"><!-- --></span>
			<span class="buttonText">Download PDF</span>
		</a>
	</div>
</div>
</div>
{/if}

</form>

{if $authority >= 1}

<br />
<br />

{/if}
