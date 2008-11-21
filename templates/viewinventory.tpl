{if $authority >= 1}
<a href="addinventory.php">Add Inventory</a>
<br>
<br>
{/if}

<table width="800" border="1">
	<tr>
		<th width="250">Item</th>
		<th>Condition</th>
		<th>Value</th>
		<th>Location</th>
		{if $authority >= 1}
			<th width="50">Loan</th>
		{/if}
		{if $authority >= 1}
			<th width="50">Edit</th>
		{/if}
		{if $authority >= 1}
			<th width="70">Delete</th>
		{/if}
	</tr>

{section name=itemLoop loop=$items}
<tr>

	<td>{$items[itemLoop]->description}</td>
	<td>{$items[itemLoop]->current_condition}</td>
	<td>{$items[itemLoop]->current_value}</td>
	<td>{$items[itemLoop]->location}</td>
	{if $authority >= 1}
		<td align="center">
		<a href="loanItem.php?id={$items[itemLoop]->inventory_id}">Loan</a>
		</td>
	{/if}
	{if $authority >= 1}
		<td align="center"><a href="editItem.php?id={$items[itemLoop]->inventory_id}">Edit</a></td>
	{/if}
	{if $authority >= 1}
		<td align="center">
		<input type="button" onclick="confirmation('Are you sure you want to delete item \'{$items[itemLoop]->description}\' ?','deleteItem.php?id={$items[itemLoop]->inventory_id}')" value="Delete">
	    </td>
	{/if}
</tr>
{/section}	


</table>