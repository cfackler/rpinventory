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
<h3>Checkouts</h3>
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
</span></div>


<table width="800" border="0" class="itemsTable" cellspacing="0">
	<tr>
	
	 {* Item *}
		<th width="250">
		{if isset($sort) && $sort == 'description' && !isset($sortdir)}
		  <a href="viewCheckouts.php?sort=description&sortdir=DESC">
		    Item
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'description' && $sortdir == 'DESC'}
		    <a href="viewCheckouts.php?sort=description">
		    Item
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewCheckouts.php?sort=description">
		    Item
		  </a>
		{/if}
		</th>
		
		{* Starting Condition *}
		<th width="175">
		{if isset($sort) && $sort == 'starting_condition' && !isset($sortdir)}
		  <a href="viewCheckouts.php?sort=starting_condition&sortdir=DESC">
		    Starting Condition
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'starting_condition' && $sortdir == 'DESC'}
		  <a href="viewCheckouts.php?sort=starting_condition">
		    Starting Condition
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewCheckouts.php?sort=starting_condition">
		    Starting Condition
		  </a>
		{/if}
		</th>
		
		{* Borrower *}
		<th width="100">
		{if isset($sort) && $sort == 'username' && !isset($sortdir)}
		  <a href="viewCheckouts.php?sort=username&sortdir=DESC">
		    Borrower
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'username' && $sortdir == 'DESC'}
		  <a href="viewCheckouts.php?sort=username">
		    Borrower
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewCheckouts.php?sort=username">
		    Borrower
		  </a>
		{/if}
		</th>
		
		{* Loan Date *}
		<th width="150">
		{* Default sorting method for table *}
		{if !isset($sort) }
		  <a href="viewCheckouts.php?sort=time_taken">
		    Time Taken
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		  </a>
		{elseif isset($sort) && $sort == 'time_taken' && !isset($sortdir)}
		  <a href="viewCheckouts.php?sort=time_taken&sortdir=DESC">
		    Time Taken
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'time_taken' && $sortdir == 'DESC'}
		  <a href="viewCheckouts.php?sort=time_taken">
		    Time Taken
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewCheckouts.php?sort=time_taken">
		    Time Taken
		  </a>
		{/if}
		</th>
		
		{* Return date *}
		<th width="120">
		{if isset($sort) && $sort == 'time_returned' && !isset($sortdir)}
		  <a href="viewCheckouts.php?sort=time_returned&sortdir=DESC">
		    Return Date
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'time_returned' && $sortdir == 'DESC'}
		  <a href="viewCheckouts.php?sort=time_returned">
		    Return Date
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewCheckouts.php?sort=time_returned">
		    Time Returned
		  </a>
		{/if}		
		</th>
		
	</tr>

{section name=itemLoop loop=$items}
<tr{cycle values=" class=\"alt\","}>

	<td>{$items[itemLoop]->description}</td>
	<td>{$items[itemLoop]->starting_condition}</td>
	<td>{$items[itemLoop]->username}</td>
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


</table>