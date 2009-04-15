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
    <h3>Businesses</h3>
	<a href="addBusiness.php">Add new business</a>
	</span></div>
	<table width="900" bsort="0" class="itemsTable" cellspacing="0">
	       <tr>
	   
      {* Company Name *}
      <th width="300">
      {* Default sorting option *}
      {if !isset($sort) }
        <a href="?sort=company_name&sortdir=DESC">
          Company Name
          <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
        </a>
      {elseif isset($sort) && $sort == 'company_name' && !isset($sortdir)}
        <a href="?sort=company_name&sortdir=DESC">
          Company Name
          <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
        </a>
      {elseif isset($sort) && $sort == 'company_name' && $sortdir == 'DESC'}
        <a href="?sort=company_name">
          Company Name
          <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
        </a>
      {else}
        <a href="?sort=company_name&sortdir=DESC">
          Company Name
        </a>
      {/if}
      </th>
      
      {* Address *}
			<th width="150">
		  {if isset($sort) && $sort == 'address' && !isset($sortdir)}
		    <a href="?sort=address&sortdir=DESC">
		      Address
		      <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		    </a>
		  {elseif isset($sort) && $sort == 'address' && $sortdir == 'DESC'}
		    <a href="?sort=address">
		      Address
		      <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		    </a>
		  {else}  
		    <a href="?sort=address">
		      Address
		    </a>
		  {/if}
		  </th>
		  
		  {* Address 2 *}
			<th width="160">
		  {if isset($sort) && $sort == 'address2' && !isset($sortdir)}
		    <a href="?sort=address2&sortdir=DESC">
		      Address 2
		      <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		    </a>
		  {elseif isset($sort) && $sort == 'address2' && $sortdir == 'DESC'}
		    <a href="?sort=address2">
		      Address 2
		      <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		    </a>
		  {else}
		    <a href="?sort=address2">
		      Address 2
		    </a>
		  {/if}
		  </th>
		  
		  {* City *}
			<th width="100">
			{if isset($sort) && $sort == 'city' && !isset($sortdir)}
			 <a href="?sort=city&sortdir=DESC">
			   City
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
			 </a>
		  {elseif isset($sort) && $sort == 'city' && $sortdir == 'DESC'}
		    <a href="?sort=city">
			   City
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
			 </a>
		  {else}
		    <a href="?sort=city">
			   City
			 </a>
		  {/if}
		  </th>
		  
		  {* State *}
			<th width="50">
			{if isset($sort) && $sort == 'state' && !isset($sortdir)}
			 <a href="?sort=state&sortdir=DESC">
			   State
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
			 </a>
		  {elseif isset($sort) && $sort == 'state' && $sortdir == 'DESC'}
		   <a href="?sort=state">
			   State
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
			 </a>
		  {else}
		    <a href="?sort=state">
			   State
			 </a>
			 {/if}
		  </th>
		  
		  {* Zip *}
			<th width="100">
			{if isset($sort) && $sort == 'zipcode' && !isset($sortdir)}
			 <a href="?sort=zipcode&sortdir=DESC">
			   Zip Code
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
			 </a>
		  {elseif isset($sort) && $sort == 'zipcode' && $sortdir == 'DESC'}
		    <a href="?sort=zipcode">
			   Zip Code
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
			 </a>
		  {else}
		    <a href="?sort=zipcode">
			   Zip Code
			 </a>
		  {/if}
		  </th>
		  
		  {* Phone *}
			<th width="100">
			{if isset($sort) && $sort == 'phone' && !isset($sortdir)}
			 <a href="?sort=phone&sortdir=DESC">
			   Phone Number
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
			 </a>
		  {elseif isset($sort) && $sort == 'phone' && $sortdir == 'DESC'}
		    <a href="?sort=phone">
			   Phone Number
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
			 </a>
		  {else}
		    <a href="?sort=phone">
			   Phone Number
			 </a>
		  {/if}
		  </th>
		  
		  {* Fax *}
			<th width="100">
			{if isset($sort) && $sort == 'fax' && !isset($sortdir)}
			 <a href="?sort=fax&sortdir=DESC">
			   Fax Number
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
			 </a>
		  {elseif isset($sort) && $sort == 'fax' && $sortdir == 'DESC'}
			 <a href="?sort=fax">
			   Fax Number
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
			 </a>
			 {else}
			   <a href="?sort=fax">
			    Fax Number
  			 </a>
  		  {/if}
		  </th>
		  
		  {* Email *}
			<th width="100">
			{if isset($sort) && $sort == 'email' && !isset($sortdir)}
			 <a href="?sort=email&sortdir=DESC">
			   Email
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
			 </a>
		  {elseif isset($sort) && $sort == 'email' && $sortdir == 'DESC'}
			 <a href="?sort=email">
			   Email
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
			 </a>
		  {else}
  			 <a href="?sort=email&sortdir=DESC">
	   		   Email
  			 </a>
		  {/if}
		  </th>
		  
		  {* website *}
			<th width="150">
			{if isset($sort) && $sort == 'website' && !isset($sortdir)}
			 <a href="?sort=website&sortdir=DESC">
			   Website
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
			 </a>
		  {elseif isset($sort) && $sort == 'website' && $sortdir == 'DESC'}
		    <a href="?sort=website">
			   Website
			   <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
			 </a>
		  {else}
		    <a href="?sort=website">
			   Website
			 </a>
			 {/if}
		  </th>
		  
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
