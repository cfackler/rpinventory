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
{*<h3>Checkouts</h3>*}
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
	
	 {* Table header *}
    {generateTableHeader headers=$headers currentSortIndex=$currentSortIndex currentSortDir=$currentSortDir}
		
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

{if $displayPaginate }
    <br />

    <div id="paginate">{paginate_prev} {paginate_middle} {paginate_next}</div>
{/if}