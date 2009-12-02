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

{if $viewLoanId > 0}
	<table class="loanTable" cellspacing="0">
        <tr>
            <th colspan="2">
                Loan
            </th>
        </tr>
		<tr>
			<td>
				<label>Item:</label>
			</td>
			<td>
				<label>{$loanObj->description}</label>
			</td>
		</tr>
		<tr class="loanAlt">
			<td>
				<label>Borrower:</label>
			</td>
			<td>
				<label>{$loanObj->name}</label>
			</td>
		</tr>
		<tr>
			<td>
				<label>Date Taken:</label>
			</td>
			<td>
				<label>{$loanObj->issue_date}</label>
			</td>
		</tr>
		<tr class="loanAlt">
			<td>
				<label>Original Location:</label>
			</td>
			<td>
				<label>{$loanObj->location}</label>
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
    	<a href="viewLoans.php">All</a>
    {else}
    	<b>All </b>
    {/if}
    |
    {if $filter != "outstanding"}
    	<a href="viewLoans.php?view=outstanding">Outstanding</a>
    {else}
    	<b>Outstanding </b>
    {/if}
    |
    {if $filter != "returned"}
    	 <a href="viewLoans.php?view=returned">Returned</a>
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
			<th width="100">Loan Date</th>
			<th width="120">Return Date</t>
		</tr>
	</thead>
	<tbody class="ui-widget-content">
	{section name=itemLoop loop=$items}
	<tr{cycle values=" class=\"alt\","}>

		<td>{$items[itemLoop]->description}</td>
		<td>{$items[itemLoop]->starting_condition}</td>
		<td>{$items[itemLoop]->name}</td>
		<td>{$items[itemLoop]->issue_date}</td>
		<td align="center">
		{if $items[itemLoop]->return_date == NULL && $authority >= 1}
			<a href="returnItem.php?id={$items[itemLoop]->loan_id}">Return</a>
		{elseif $items[itemLoop]->return_date == NULL}
			Out
		{else}
			{$items[itemLoop]->return_date}
		{/if}
	
		</td>
	</tr>
	{/section}	
	</tbody>

</table>

{/if}
	
