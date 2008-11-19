<form name="editItem" action="updateItem.php" METHOD="post">

<h3>Edit Item</h3>

<table width="400">

<input type="hidden" name="inventory_id" size="40" value="{$item->inventory_id}">

<tr>
	<td>Description: </td>
	<td><input type="text" name="desc" size="40" value="{$item->description}"></td>
</tr>

<tr>
	<td>Value: </td>
	<td><input type="text" name="value" size="40" value="{$item->current_value}"></td>
</tr>

<tr>
	<td>Condition: </td>
	<td>
		<select name="condition">
			<option value="Excellent" {if $item->current_condition == "Excellent"}selected{/if}>Excellent</option>
			<option value="Good" {if $item->current_condition == "Good"}selected{/if}>Good</option>
			<option value="Fair" {if $item->current_condition == "Fair"}selected{/if}>Fair</option>
			<option value="Poor" {if $item->current_condition == "Poor"}selected{/if}>Poor</option>
		</select>
	</td>
</tr>

<tr>
	<td>Location: </td>
	<td>
	
	<select name="location">
	{section name=loc loop=$locations}
		<option value="{$locations[loc]->location_id}"  {if $locations[loc]->location_id == $item->location_id}selected{/if}>
			{$locations[loc]->location}
		</option>
	{/section}
	</select>
	
	</td>
</tr>

</table>

<br>
<input type="submit" value="Edit">

<form>
