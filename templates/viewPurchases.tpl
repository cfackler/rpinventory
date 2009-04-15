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
	<div class="TopOfTable"><span class="TopOfTable">
    <h3>Purchases</h3>
    <a href="addPurchase.php">Add a purchase</a>
    </span>
    </div>
    <table width="800" border="0" class="itemsTable" cellspacing="0">
    	<tr>
    
    {* Items *}
		<th width="150">
		{* Sorting default *}
		{if !isset($sort) }
		  <a href="viewPurchases.php?sort=purchase_id&sortdir=DESC">
		    Items
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'purchase_id' && !isset($sortdir)}
		  <a href="viewPurchases.php?sort=purchase_id&sortdir=DESC">
		    Items
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'purchase_id' && $sortdir == 'DESC'}
		  <a href="viewPurchases.php?sort=purchase_id">
		    Items
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		  </a>
		{else} 
		  <a href="viewPurchases.php?sort=purchase_id">
		    Items
		  </a>
		{/if}
		</th>
		
		{* Company Name *}
		<th width="250">
		{if isset($sort) && $sort == 'company_name' && !isset($sortdir)}
		  <a href="viewPurchases.php?sort=company_name&sortdir=DESC">
		    Company Name
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'company_name' && $sortdir == 'DESC'}
		  <a href="viewPurchases.php?sort=company_name">
		    Company Name
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewPurchases.php?sort=company_name">
		    Company Name
		  </a>
		{/if}
		</th>
		
		{* Purchase Date *}
		<th width="125">
		{if isset($sort) && $sort == 'purchase_date' && !isset($sortdir)}
		  <a href="viewPurchases.php?sort=purchase_date&sortdir=DESC">
		    Date
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'purchase_date' && $sortdir == 'DESC'}
		  <a href="viewPurchases.php?sort=purchase_date">
		    Date
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewPurchases.php?sort=purchase_date">
		    Date
		  </a>
		{/if}
		</th>
		
		{* Total Cost *}
		<th width="150">
		{if isset($sort) && $sort == 'total_price' && !isset($sortdir)}
		  <a href="viewPurchases.php?sort=total_price&sortdir=DESC">
		    Total Cost
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'total_price' && $sortdir == 'DESC'}
		  <a href="viewPurchases.php?sort=total_price">
		    Total Cost
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewPurchases.php?sort=total_price">
		    Total Cost
		  </a>
		{/if}
		</th>
		
	</tr>

    {section name=itemLoop loop=$purchases}
    <tr{cycle values=" class=\"alt\","}>

	<td>{$purchaseItems[itemLoop]}</td>
	<td>{$purchases[itemLoop]->company_name}</td>
	<td>{$purchases[itemLoop]->purchase_date}</td>
	<td>${$purchases[itemLoop]->total_price}</td>
    </tr>
    {/section}	


    </table>
{else}
    <h3>Purchases</h3>

    <p>Please login if you wish to view information about purchases.</p>
{/if}