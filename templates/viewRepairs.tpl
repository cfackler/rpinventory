{*
    Copyright (C) 2010, All Rights Reserved.

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
	  <!-- -->
	</div>
</div>

<table width="800" class="itemsTable sortable searchable ui-widget ui-corner-all" cellspacing="0">
	<thead class="ui-widget-header">
		<tr>
    	<th width="200">Item</th>
			<th width="150">Company Name</th>
			<th width="75">Date</th>
			<th width="50">Cost</th>
			<th width="250">Description</th>		
		</tr>
	</thead>
	<tbody class="ui-widget-content">

		{section name=itemLoop loop=$items}
		<tr{cycle values=" class=\"alt\","}>

			<td>{$items[itemLoop]->inv_description}</td>
			<td><a href="viewBusinessAddress.php?id={$items[itemLoop]->business_id}">{$items[itemLoop]->company_name}</td>
			<td>{$items[itemLoop]->repair_date}</td>
			<td>${$items[itemLoop]->repair_cost}</td>
			<td>{$items[itemLoop]->rep_description}</td>
		</tr>
		{/section}	
	</tbody>
</table>

{else}
<div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
  <h3 class="ui-widget-header ui-corner-all">Repairs</h3>
  <p>Please login if you wish to view information about repairs.</p>
</div>
{/if}
