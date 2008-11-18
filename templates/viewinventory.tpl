<table width="500" border="1">
	<tr>
		<th>Item</th>
		<th>Condition</th>
		<th>Value</th>
		<th>Location</th>
	</tr>

{section name=itemLoop loop=$items}
<tr>

	<td>{$items[itemLoop]->description}</td>
	<td>{$items[itemLoop]->current_condition}</td>
	<td>{$items[itemLoop]->current_value}</td>
	<td>{$items[itemLoop]->location}</td>
</tr>
{/section}	


</table>