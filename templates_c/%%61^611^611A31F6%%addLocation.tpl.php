<?php /* Smarty version 2.6.22, created on 2009-03-25 12:45:56
         compiled from addLocation.tpl */ ?>

<form name="addLocation" action="insertLocation.php" onsubmit="return ValidateForm()" METHOD="post">

<h3>Add Location</h3>

<table width="400">


<tr>
	<td>Location: </td>
	<td><input type="text" name="location" id="location" class="validate" size="40" onchange="sendValidateRequest('location')"></td>
</tr>

<tr>
	<td>Description: </td>
	<td><textarea name="description" rows="6" cols="30" id="description" class="validate"></textarea></td>
</tr>

</table>

<br>
<input type="submit" value="Add">

<form>