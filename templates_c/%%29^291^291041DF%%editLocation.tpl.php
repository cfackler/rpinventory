<?php /* Smarty version 2.6.22, created on 2009-04-08 00:18:56
         compiled from editLocation.tpl */ ?>

<form name="addLocation" action="updateLocationRecord.php" onsubmit="return ValidateForm()" METHOD="post">

<h3>Edit Location</h3>

<table width="400">

<input type="hidden" id="location_id" name="location_id" value="<?php echo $this->_tpl_vars['location']->location_id; ?>
">
<tr>
	<td>Location: </td>
	<td><input type="text" name="location_edit" size="40" value="<?php echo $this->_tpl_vars['location']->location; ?>
" id="location_edit" class="validate" onchange="sendValidateRequest('location_edit')"></td>
</tr>

<tr>
	<td>Description: </td>
	<td><textarea name="description" rows="6" cols="30" id="location" class="validate"><?php echo $this->_tpl_vars['location']->description; ?>
</textarea></td>
</tr>

</table>

<br>
<input type="submit" value="Edit">

<form>