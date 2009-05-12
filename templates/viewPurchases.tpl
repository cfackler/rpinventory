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

{if $authority>1}
{*	<div class="TopOfTable"><span class="TopOfTable">
    <h3>Purchases</h3>
    <a href="addPurchase.php">Add a purchase</a>
    </span>
    </div>*}
    <table width="800" border="0" class="itemsTable" cellspacing="0">
    	<tr>
    
            {* Table header *}
    {generateTableHeader headers=$headers currentSortIndex=$currentSortIndex currentSortDir=$currentSortDir}

		
	</tr>

    {section name=itemLoop loop=$purchases}
    <tr{cycle values=" class=\"alt\","}>
	<td>{$purchases[itemLoop]->items}</td>
	<td>{$purchases[itemLoop]->company_name}</td>
	<td>{$purchases[itemLoop]->purchase_date}</td>
	<td>${$purchases[itemLoop]->total_price}</td>
    </tr>
    {/section}	


    </table>
    {if $displayPaginate }
    	<br />

	<div id="paginate">{paginate_prev} {paginate_middle} {paginate_next}</div>
    {/if}
{else}
    <h3>Purchases</h3>

    <p>Please login if you wish to view information about purchases.</p>
{/if}