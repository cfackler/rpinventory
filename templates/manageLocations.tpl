<h3><a href="addLocation.php">Add new location</a></h3>

<table width="700" border="1">
	<tr>
		<th width="200">Location</th>
		<th width="300">Description</th>
		<th>Actions</th>
	</tr>

{section name=num loop=$locations}
<tr>

	<td align="center">{$locations[num]->location}</td>
	<td align="center">{$locations[num]->description}</td>
	<td align="center">
	<a href="editLocation.php?id={$locations[num]->location_id}">Edit</a> | 
	<input type="button" onclick="confirmation('Are you sure you want to delete location \'{$locations[num]->location}\' ?','deleteLocation.php?id={$locations[num]->location_id}')" value="Delete">
	</td>
</tr>
{/section}	


</table>