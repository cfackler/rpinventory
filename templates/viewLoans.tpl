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
<div class="TopOfTable">
<span class="TopOfTable">
<h3>Loans</h3>
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
		<th width="250">Item</th>
		<th>Starting Condition</th>
		<th>Borrower</th>
		<th>Loan Date</th>
		<th width="100">Return Date</th>
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