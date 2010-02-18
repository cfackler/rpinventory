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
		<a id="addBusiness" class="ui-state-default ui-corner-all button" href="addBusiness.php">
			<span class="ui-icon ui-icon-circle-plus"><!-- --></span>
			<span class="buttonText">Add new business</span>
		</a>
	</div>
</div>

	<table width="900" bsort="0" class="itemsTable sortable searchable ui-widget ui-corner-all" cellspacing="0">
		<thead class="ui-widget-header">
			<tr>
				<th width = "300">Company Name</th>
				<th width="150">Address</th>
				<th width="160">Address 2</th>
				<th width="100">City</th>
				<th width="50">State</th>
				<th width="100">Zip Code</th>
				<th width="100">Phone Number</th>
				<th width="100">Fax Number</th>
				<th width="100">Email</th>
				<th width="150">Website</th>
			</tr>
		</thead>
		<tbody class="ui-widget-content">
			{section name=busLoop loop=$businesses}
			<tr{cycle values=" class=\"alt\","}>
				<td align="center">{$businesses[busLoop]->company_name}</td>
				<td align="center">{$businesses[busLoop]->address}</td>
				<td align="center">{$businesses[busLoop]->address2}</td>
				<td align="center">{$businesses[busLoop]->city}</td>
				<td align="center">{$businesses[busLoop]->state}</td>
				<td align="center">{$businesses[busLoop]->zipcode}</td>
				<td align="center">{$businesses[busLoop]->phone}</td>
				<td align="center">{$businesses[busLoop]->fax}</td>
				<td align="center"><a href="mailto:{$businesses[busLoop]->email}">{$businesses[busLoop]->email}</td>
				<td align="center"><a href="{$businesses[busLoop]->website}">{$businesses[busLoop]->website}</td>
			</tr>
			{/section}
		</tbody>
	</table>

{else}
<div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
  <h3 class="ui-widget-header ui-corner-all">Businesses</h3>
  <p>Please login if you wish to view information about businesses.</p>
</div>
{/if}
