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
<h3>Borrowers</h3>
</span>
</div>

{if $authority >= 1}
    <table width="800" border="0" cellspacing="0" class="itemsTable">
    	<tr>
    	
    {* Name *}
    <th width="150">
    {* Default sorting option for all columns *}
    {if !isset($sort) }
      <a class="tableHeaderLink" href="viewBorrowers.php?sort=name&sortdir=DESC">
        Name
        <img src="images/sortTriangleUp.png" />
      </a>
    {elseif $sort == 'name' && !isset($sortdir)}
      <a class="tableHeaderLink" href="viewBorrowers.php?sort=name&sortdir=DESC">
        Name
        <img src="images/sortTriangleUp.png" />
      </a>
    {elseif $sort == 'name' && $sortdir == 'DESC'}
      <a class="tableHeaderLink" href="viewBorrowers.php?sort=name">
        Name
        <img src="images/sortTriangleDown.png" />
      </a>
    {else}
      <a class="tableHeaderLink" href="viewBorrowers.php?sort=name">
        Name
      </a>
    {/if}
    </th>
    
    {* RIN *}
		<th width="100">
		{if isset($sort) && $sort == 'rin' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=rin&sortdir=DESC">
		    RIN
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'rin' && $sortdir == 'DESC'}
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=rin">
		    RIN
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		    <a class="tableHeaderLink" href="viewBorrowers.php?sort=rin">
		    RIN
		  </a>
		{/if}
		</th>
		
		{* Email *}
		<th width="150">
		{if isset($sort) && $sort == 'email' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=email&sortdir=DESC">
		    Email
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'email' && $sortdir == 'DESC'}
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=email">
		    Email
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=email">
		    Email
		  </a>
		{/if}
		</th>
		
		{* Address *}
		<th>
		{if isset($sort) && $sort == 'address' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=address&sortdir=DESC">
		    Address
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'address' && $sortdir == 'DESC'}
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=address">
		    Address
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=address">
		    Address
		  </a>
		{/if}		
		</th>
		
		{* Phone *}
		<th width="100">
		{if isset($sort) && $sort == 'phone' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=phone&sortdir=DESC">
		    Phone
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'phone' && $sortdir == 'DESC'}
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=phone">
		    Phone
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=phone">
		    Phone
		  </a>
		{/if}
		</th>

	</tr>

	{section name=num loop=$borrowers}
	<tr{cycle values=" class=\"alt\","}>
		<td align="center">{$borrowers[num]->name}</td>
		<td align="center">{$borrowers[num]->rin}</td>
		<td align="center">{$borrowers[num]->email}</td>
		
		<td align="center">
			{$borrowers[num]->address}<br>
			
			{if $borrowers[num]->address2 != NULL}
			{$borrowers[num]->address2}<br>
			{/if}
			
			{$borrowers[num]->city}, {$borrowers[num]->state} {$borrowers[num]->zipcode}<br>
		</td>
		
		<td align="center">{$borrowers[num]->phone}</td>
		
	</tr>
	{/section}
    </table>
{else}
    <p>Please login if you wish to view information about borrowers</p>
{/if}