<form name="addLocation" action="updateLocationRecord.php" METHOD="post">

<h3>Edit Location</h3>

<table width="400">

<input type="hidden" name="location_id" value="{$location->location_id}">
<tr>
	<td>Location: </td>
	<td><input type="text" name="location" size="40" value="{$location->location}"></td>
</tr>

<tr>
	<td>Description: </td>
	<td><textarea name="description" rows="6" cols="30">{$location->description}</textarea></td>
</tr>

</table>

<br>
<input type="submit" value="Edit">

<form>
