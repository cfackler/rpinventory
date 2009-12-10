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

{if $viewCheckoutId > 0}
	<table class="loanTable" cellspacing="0">
        <tr>
            <th colspan="2">
                Checkout
            </th>
        </tr>
		<tr>
			<td>
				<label>Item:</label>
			</td>
			<td>
				<label>{$checkoutObj->description}</label>
			</td>
		</tr>
		<tr class="loanAlt">
			<td>
				<label>Borrower:</label>
			</td>
			<td>
				<label>{$checkoutObj->name}</label>
			</td>
		</tr>
		<tr>
			<td>
				<label>Date Taken:</label>
			</td>
			<td>
				<label>{$checkoutObj->time_taken}</label>
			</td>
		</tr>
		<tr class="loanAlt">
			<td>
				<label>Original Location:</label>
			</td>
			<td>
				<label>{$checkoutObj->location}</label>
			</td>
		</tr>
	</table>

	<br />

	<a href="javascript:history.go(-1)">Go back</a>
{else}

<div id="controlsTop" class="ui-widget-smaller ui-widget-content ui-corner-all controls">
	<div class="left">
		<h3>Search:</h3>
		<input type="text" id="searchField" class="searchField" />
	</div>
	<div class="right">
		Show:
    {if $filter != "all"}
    	<a href="viewCheckouts.php">All</a>
    {else}
    	<b>All </b>
    {/if}
    |
    {if $filter != "outstanding"}
    	<a href="viewCheckouts.php?view=outstanding">Outstanding</a>
    {else}
    	<b>Outstanding </b>
    {/if}
    |
    {if $filter != "returned"}
    	 <a href="viewCheckouts.php?view=returned">Returned</a>
    {else}
    	<b>Returned </b>
    {/if}
	</div>
</div>

<table width="800" border="0" class="itemsTable sortable searchable ui-widget ui-corner-all" cellspacing="0">
	<thead class="ui-widget-header">
		<tr>
			<th width="250">Item</th>
			<th width="175">Starting Condition</th>
			<th width="100">Borrower</th>
			<th width="150">Time Taken</th>
			<th width="120">Return Date</th>
		</tr>
	</thead>
	<tbody class="ui-widget-content">		
		{section name=itemLoop loop=$items}
		<tr{cycle values=" class=\"alt\","}>

			<td>{$items[itemLoop]->description}</td>
			<td>{$items[itemLoop]->starting_condition}</td>
			<td>{$items[itemLoop]->name}</td>
			<td>{$items[itemLoop]->time_taken}</td>
			<td align="center">
			{if $items[itemLoop]->time_returned == NULL && $authority >= 1}
				<a href="returnCheckoutItem.php?id={$items[itemLoop]->checkout_id}">Return</a>
			{elseif $items[itemLoop]->time_returned == NULL}
				Out
			{else}
				{$items[itemLoop]->time_returned}
			{/if}
	
			</td>
		</tr>
		{/section}	
	</tbody>
</table>

{/if}
