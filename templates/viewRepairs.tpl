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

<div class="TopOfTable"><span class="TopOfTable">
<h3>Repairs</h3>
</span>
</div>
{if $authority>1}
    <table width="800" border="0" class="itemsTable" cellspacing="0">
    	<tr>
    {* Item *}		
		<th width="200">
		{* Default sorting option for table *}
		{if !isset($sort) }
		  <a href="viewRepairs.php?sort=inv_description&sortdir=DESC">
		    Item
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'inv_description' && !isset($sortdir)}
		  <a href="viewRepairs.php?sort=inv_description&sortdir=DESC">
		    Item
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'inv_description' && $sortdir == 'DESC'}
		  <a href="viewRepairs.php?sort=inv_description">
		    Item
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewRepairs.php?sort=inv_description">
		    Item
		  </a>
		{/if}
		</th>
		
		{* Company name *}
		<th>
		{if isset($sort) && $sort == 'company_name' && !isset($sortdir)}
		  <a href="viewRepairs.php?sort=company_name&sortdir=DESC">
		    Company Name
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'company_name' && $sortdir == 'DESC'}
		  <a href="viewRepairs.php?sort=company_name">
		    Company Name
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewRepairs.php?sort=company_name">
		    Company Name
		  </a>
		{/if}
		</th>
		
		{* Repair Date *}
		<th>
		{if isset($sort) && $sort == 'repair_date' && !isset($sortdir)}
		  <a href="viewRepairs.php?sort=repair_date&sortdir=DESC">
		    Date
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'repair_date' && $sortdir == 'DESC'}
		  <a href="viewRepairs.php?sort=repair_date">
		    Date
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewRepairs.php?sort=repair_date">
		    Date
		  </a>
		{/if}
		</th>
		
		{* Repair Cost *}
		<th>
		{if isset($sort) && $sort == 'repair_cost' && !isset($sortdir)}
		  <a href="viewRepairs.php?sort=repair_cost&sortdir=DESC">
		    Cost
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'repair_cost' && $sortdir == 'DESC'}
		  <a href="viewRepairs.php?sort=repair_cost">
		    Cost
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewRepairs.php?sort=repair_cost">
		    Cost
		  </a>
		{/if}
		</th>
		
		{* Description *}
		<th width="250">
		{if isset($sort) && $sort == 'rep_description' && !isset($sortdir)}
		  <a href="viewRepairs.php?sort=rep_description&sortdir=DESC">
		    Description
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'rep_description' && $sortdir == 'DESC'}
		  <a href="viewRepairs.php?sort=rep_description">
		    Description
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewRepairs.php?sort=rep_description">
		    Description
		  </a>
		{/if}
		</th>
		
	</tr>

    {section name=itemLoop loop=$items}
    <tr{cycle values=" class=\"alt\","}>

	<td>{$items[itemLoop]->inv_description}</td>
	<td><a href="viewAddress.php?id={$items[itemLoop]->business_id}">{$items[itemLoop]->company_name}</td>
	<td>{$items[itemLoop]->repair_date}</td>
	<td>${$items[itemLoop]->repair_cost}</td>
	<td>{$items[itemLoop]->rep_description}</td>
    </tr>
    {/section}	


    </table>
{else}
    <h3>Repairs</h3>

    <p>Please login if you wish to view information about repairs.</p>
{/if}