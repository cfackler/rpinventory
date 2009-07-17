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
	<span class="TopOfTable">
		<h3>Loan</h3>
	</span>

	<br />

	<table>
		<tr>
			<td>
				<label>Item:</label>
			</td>
			<td>
				<label>{$loanObj->description}</label>
			</td>
		</tr>
		<tr>
			<td>
				<label>Borrower:</label>
			</td>
			<td>
				<label>{$loanObj->username}</label>
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
		<tr>
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


<div class="TopOfTable">
<span class="TopOfTable">
{*<h3>Loans</h3>*}
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
</span></div>


<table width="800" border="0" class="itemsTable" cellspacing="0">
	<tr>
	
	 {* Table header *}
    {generateTableHeader headers=$headers currentSortIndex=$currentSortIndex currentSortDir=$currentSortDir}

		
	</tr>

{section name=itemLoop loop=$items}
<tr{cycle values=" class=\"alt\","}>

	<td>{$items[itemLoop]->description}</td>
	<td>{$items[itemLoop]->starting_condition}</td>
	<td>{$items[itemLoop]->username}</td>
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


</table>

{if $displayPaginate }
    <br />

    <div id="paginate">{paginate_prev} {paginate_middle} {paginate_next}</div>
{/if}
{/if}
	
