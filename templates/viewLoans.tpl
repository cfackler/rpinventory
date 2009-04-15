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
	
	 {* Item *}
		<th width="250">
		{if isset($sort) && $sort == 'description' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=description&sortdir=DESC">
		    Item
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'description' && $sortdir == 'DESC'}
		    <a class="tableHeaderLink" href="viewLoans.php?sort=description">
		    Item
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=description">
		    Item
		  </a>
		{/if}
		</th>
		
		{* Starting Condition *}
		<th>
		{if isset($sort) && $sort == 'starting_condition' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=starting_condition&sortdir=DESC">
		    Starting Condition
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'starting_condition' && $sortdir == 'DESC'}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=starting_condition">
		    Starting Condition
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=starting_condition">
		    Starting Condition
		  </a>
		{/if}
		</th>
		
		{* Borrower *}
		<th>
		{if isset($sort) && $sort == 'username' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=username&sortdir=DESC">
		    Borrower
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'username' && $sortdir == 'DESC'}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=username">
		    Borrower
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=username">
		    Borrower
		  </a>
		{/if}
		</th>
		
		{* Loan Date *}
		<th>
		{* Default sorting method for table *}
		{if !isset($sort) }
		  <a class="tableHeaderLink" href="viewLoans.php?sort=issue_date">
		    Loan Date
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{elseif isset($sort) && $sort == 'issue_date' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=issue_date&sortdir=DESC">
		    Loan Date
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'issue_date' && $sortdir == 'DESC'}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=issue_date">
		    Loan Date
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=issue_date">
		    Loan Date
		  </a>
		{/if}
		</th>
		
		{* Return date *}
		<th width="100">
		{if isset($sort) && $sort == 'return_date' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=return_date&sortdir=DESC">
		    Return Date
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'return_date' && $sortdir == 'DESC'}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=return_date">
		    Return Date
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="viewLoans.php?sort=return_date">
		    Return Date
		  </a>
		{/if}		
		</th>
		
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