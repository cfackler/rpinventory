<form name="editItem" action="updateItem.php" METHOD="post">

<h3>Edit Item</h3>

<input type="hidden" name="count" size="40" value="{$itemCount}">

{section name=num loop=$items}

<table width="400">

<input type="hidden" name="inventory_id{$smarty.section.num.index}" size="40" value="{$items[num]->inventory_id}">

<tr>
	<td>Description:
</td>
	<td><input type="text" name="desc{$smarty.section.num.index}" size="40" value="{$items[num]->description}"></td>
</tr>

<tr>
	<td>Value: </td>
	<td><input type="text" name="value{$smarty.section.num.index}" size="40" value="{$items[num]->current_value}"></td>
</tr>

<tr>
	<td>Condition: </td>
	<td>
		<select name="condition{$smarty.section.num.index}">
			<option value="Excellent" {if $items[num]->current_condition == "Excellent"}selected{/if}>Excellent</option>
			<option value="Good" {if $items[num]->current_condition == "Good"}selected{/if}>Good</option>
			<option value="Fair" {if $items[num]->current_condition == "Fair"}selected{/if}>Fair</option>
			<option value="Poor" {if $items[num]->current_condition == "Poor"}selected{/if}>Poor</option>
		</select>
	</td>
</tr>

<tr>
	<td>Location: </td>
	<td>
	
	<select name="location{$smarty.section.num.index}">
	{section name=loc loop=$locations}
		<option value="{$locations[loc]->location_id}"  {if $locations[loc]->location_id == $items[num]->location_id}selected{/if}>
			{$locations[loc]->location}
		</option>
	{/section}
	</select>
	
	</td>
</tr>

</table>

<br>
<br>

{/section}

<br>
<input type="submit" value="Edit">

<form>
