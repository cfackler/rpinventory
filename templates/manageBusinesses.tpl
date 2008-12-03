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

{if $authority>=1}
	<a href="addBusiness.php">Add new business</a>
	<br />
	<br />
	<table width="900" border="0" class="itemsTable" cellspacing="0">
	       <tr>
			<th width="200">Company Name</th>
			<th width="150">Address</th>
			<th width="160">Address 2</th>
			<th width="100">City</th>
			<th width="20">State</th>
			<th width="100">Zip Code</th>
			<th width="100">Phone Number</th>
			<th width="100">Fax Number</th>
			<th width="100">Email</th>
			<th width="150">Website</th>
		</tr>

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


	</table>
{else}
    <h3>Businesses</h3>

    <p>Please login if you wish to view information about businesses.</p>
{/if}
