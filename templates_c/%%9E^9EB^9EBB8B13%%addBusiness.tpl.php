<?php /* Smarty version 2.6.22, created on 2009-02-11 13:22:18
         compiled from addBusiness.tpl */ ?>

<form name="addBusiness" action="insertBusiness.php" onsubmit="return ValidateForm(this)" METHOD="post">

<h3>Add Business</h3>

<table width="410">


<tr>
	<td>Company Name: </td>
	<td><input type="text" name="company" id="company" class="validate" size="40"></td>
</tr>

<tr>
	<td>Address: </td>
	<td><input type="text" name="address" id="address" class="validate" size="40"></td>
</tr>

<tr>
	<td>Address 2: </td>
	<td><input type="text" name="address2" id="address2" size="40"></td>
</tr>

<tr>
	<td>City: </td>
	<td><input type="text" name="city" id="city" class="validate" size="40"></td>
</tr>

<tr>
	<td>State: </td>
	<td><input type="text" name="state" id="state" class="validate" size="10"></td>
</tr>

<tr>
	<td>Zip Code: </td>
	<td><input type="text" name="zip" id="zip" class="validate" size="10"></td>
</tr>

<tr>
	<td>Phone Number: </td>
	<td><input type="text" name="phone" id="phone" class="validate" size="20"></td>
</tr>

<tr>
	<td>Fax Number: </td>
	<td><input type="text" name="fax" id="fax" size="20"></td>
</tr>

<tr>
	<td>E-mail: </td>
	<td><input type="text" name="email" id="email" size="40"></td>
</tr>

<tr>
	<td>Website: </td>
	<td><input type="text" name="website" id="website" class="validate" size="40"></td>
</tr>

</table>

<br>
<input type="submit" value="Add">

<form>