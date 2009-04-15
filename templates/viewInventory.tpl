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


<form id="itemList" name="itemList">

<table width="800" border="0" class="itemsTable" cellspacing="0" >
	<tr>
		{if $authority >= 1}
			<th width="20"> </th>
		{/if}

    {* Table headers with sorting links *}
    
    {* Description *}
    <th width="250">
    
    {* Default sorting option for all columns *}
    {if !isset($sort) }
		  <a href="viewInventory.php?sort=description&sortdir=DESC">
		    Item
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
    
    {*  if we are already sorting by description, provide option to sort
        descending *}
		{elseif $sort == 'description' && !isset($sortdir)}
		  <a href="viewInventory.php?sort=description&sortdir=DESC">
        Item
        <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
      </a>

		{*  if we are already sorting descending, provide option to sort asc *}
		{elseif $sort == 'description' && $sortdir == 'DESC'}
		  <a href="viewInventory.php?sort=description">
		    Item
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
      </a>
    {*  if we are already sorting by another column, provide option and 
        don't show triangle. *}
    {else}
      <a href="viewInventory.php?sort=description">
		    Item
      </a>
		  {/if}
		</th>
		
		{if $authority >= 1}

  		{* Current Condition *}
  		<th width="100">
  		
  		{*  if we are sorting by the current condition, ascending, 
  		    display link to sort descending *}
  		{if isset($sort) && $sort == 'current_condition' && !isset($sortdir)}
  		<a href="viewInventory.php?sort=current_condition&sortdir=DESC">
  		  Condition
  		  <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
  		</a>
  		
  		{*  if we are sorting by the current condition, descending,
  		    display link to sort ascending *}
  		{elseif $sort == 'current_condition' && $sortdir == 'DESC'}
  		<a href="viewInventory.php?sort=current_condition">
  		  Condition
  		  <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
  		</a>
  		
  		{*  else, we are sorting by another column so display the link
  		    without the sorting indicator *}
  		{else}
  		<a href="viewInventory.php?sort=current_condition">
  		  Condition
  		</a>
  		{/if}
  		</th>
  		
  		{* Current Value *}
  		<th width = "150">
  		{*  if we are sorting by the current value, ascending,
  		    display link to sort descending *}
  		{if isset($sort) && $sort == 'current_value' && !isset($sortdir) }
  		  <a href="viewInventory.php?sort=current_value&sortdir=DESC">
  		    Value
  		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
  		  </a>
  		{*  if we are sorting by current value descending
  		    display link to sort ascending *}
  		{elseif $sort == 'current_value' && $sortdir == 'DESC'}
  	    <a href="viewInventory.php?sort=current_value">
  	      Value
  	      <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
  	    </a>
  		{*  else, we are sorting by a different column *}
  		{else}
  		  <a href="viewInventory.php?sort=current_value">
  		    Value
  		  </a>
  		{/if}
  		</th>
		
		{/if}
		{* Location *}
		<th width="150">
		{if isset($sort) && $sort == 'location' && !isset($sortdir)}
		  <a href="viewInventory.php?sort=location&sortdir=DESC">
		    Location
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
		{elseif $sort == 'location' && $sortdir == 'DESC'}
		  <a href="viewInventory.php?sort=location">
		    Location
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a href="viewInventory.php?sort=location">
		    Location
		  </a>
		{/if}
		</th>

		</tr>

{section name=itemLoop loop=$items}
<tr{cycle values=" class=\"alt\","}>
	{if $authority >= 1}
		<td><input type="checkbox" name="{$items[itemLoop]->inventory_id}" id="{$items[itemLoop]->inventory_id}"></td>
	{/if}
	<td>{$items[itemLoop]->description}</td>
	{if $authority >= 1}
		<td>{$items[itemLoop]->current_condition}</td>
		<td>{$items[itemLoop]->current_value}</td>
	{/if}
	<td align="center">{$items[itemLoop]->location}</td>
</tr>
{/section}	


</table>
<br>

{if $authority >= 1}
	
<select class="dropDown" name="action_list" id="action_list">
	<option value="Loan">Loan</option>
	<option value="Checkout">Checkout</option>
	<option value="Edit">Edit</option>
	<option value="Repair">Repair</option>
	<option value="Delete">Delete</option>

</select>


<input type="button" class="button" onclick="submitItems()" value="Go">
{/if}

</form>

{if $authority >= 1}

<br />

{/if}

<a href="makeInventorySummary.php"><img border="0" src="images/pdficon_small.gif" />&nbsp;&nbsp;Download PDF</a>

