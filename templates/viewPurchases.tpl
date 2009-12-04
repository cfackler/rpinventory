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

{if $authority>1}
<div id="controlsTop" class="ui-widget-smaller ui-widget-content ui-corner-all controls">
	<div class="left">
		<h3>Search:</h3>
		<input type="text" id="searchField" class="searchField" />
	</div>
	<div class="right">
		<a id="addPurchase" class="ui-state-default ui-corner-all button" href="addPurchase.php">
			<span class="ui-icon ui-icon-circle-plus"><!-- --></span>
			<span class="buttonText">Insert inventory</span>
		</a>
	</div>
</div>

    <table width="800" border="0" class="itemsTable sortable searchable ui-widget ui-corner-all" cellspacing="0">
    	<thead class="ui-widget-header">
				<tr>
					<th width="150">Items</th>
					<th width="250">Company Name</th>
					<th width="125">Date</th>
					<th width="150">Total Cost</th>
				</tr>
			</thead>
			<tbody class="ui-widget-content">

		    {section name=itemLoop loop=$purchases}
		    <tr{cycle values=" class=\"alt\","}>
			<td>{$purchases[itemLoop]->items}</td>
			<td>{$purchases[itemLoop]->company_name}</td>
			<td>{$purchases[itemLoop]->purchase_date}</td>
			<td>${$purchases[itemLoop]->total_price}</td>
		    </tr>
		    {/section}	
			</tbody>

    </table>
{else}
<div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
  <h3 class="ui-widget-header ui-corner-all">Purchases</h3>
  <p>Please login if you wish to view information about purchases.</p>
</div>
{/if}