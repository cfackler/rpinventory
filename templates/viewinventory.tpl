{if $authority >= 1}
<a href="addinventory.php">Add Inventory</a>
<br>
<br>
{/if}

<form id="itemList" name="itemList">

<table width="800" border="0" class="itemsTable" cellspacing="0" >
	<tr>
		{if $authority >= 1}
			<th width="20"> </th>
		{/if}
		<th width="250">Item</th>
		<th width="100">Condition</th>
		<th>Value</th>
		<th>Location</th>
	</tr>

{section name=itemLoop loop=$items}
<tr{cycle values=" class=\"alt\","}>
	{if $authority >= 1}
		<td><input type="checkbox" name="{$items[itemLoop]->inventory_id}" id="{$items[itemLoop]->inventory_id}"></td>
	{/if}
	<td>{$items[itemLoop]->description}</td>
	<td>{$items[itemLoop]->current_condition}</td>
	<td>{$items[itemLoop]->current_value}</td>
	<td align="center">{$items[itemLoop]->location}</td>
</tr>
{/section}	


</table>
<br>

{if $authority >= 1}
	
<select name="action_list" id="action_list">

<option value="Loan">Loan</option>
<option value="Edit">Edit</option>
<option value="Delete">Delete</option>
</select>


<input type="button" onclick="submitItems()" value="Go">
{/if}

</form>