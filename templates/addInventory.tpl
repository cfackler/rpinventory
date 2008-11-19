<form name="addInventory" action="insertInventory.php" METHOD="post">

<h3>Add Item</h3>

<table width="400">


<tr>
	<td>Description: </td>
	<td><input type="text" name="desc" size="40"></td>
</tr>

<tr>
	<td>Value: </td>
	<td><input type="text" name="value" size="40"></td>
</tr>

<tr>
	<td>Condition: </td>
	<td>
		<select name="condition">
			<option value="Excellent">Excellent</option>
			<option value="Good">Good</option>
			<option value="Fair">Fair</option>
			<option value="Poor">Poor</option>
		</select>
	</td>
</tr>

<tr>
	<td>Location: </td>
	<td>
	
	<select name="location">
	{section name=loc loop=$locations}
		<option value="{$locations[loc]->location_id}">
			{$locations[loc]->location}
		</option>
	{/section}
	</select>
	
	</td>
</tr>

</table>

<br>
<input type="submit" value="Add Item">

<form>
