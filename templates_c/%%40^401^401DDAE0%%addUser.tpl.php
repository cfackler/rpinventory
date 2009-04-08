<?php /* Smarty version 2.6.22, created on 2009-04-08 12:23:24
         compiled from addUser.tpl */ ?>

<form name="storeTransaction" action="addUserRecord.php" onsubmit="return ValidateForm()" METHOD="post">

<h3>Add User</h3>

<table width="400">

<tr>
	<td>Name: </td>
	<td><input type="text" name="name" size="40" id="name" class="validate"></td>
</tr>

<tr>
	<td>RIN: </td>
	<td><input type="text" name="rin" size="40" id="RIN" class="validate"></td>
</tr>

<tr>
	<td>Email: </td>
	<td><input type="text" name="email" size="40" id="email" class="validate"></td>
</tr>

<tr>
	<td>Username: </td>
	<td><input type="text" name="username" size="40" id="username" class="validate"></td>
</tr>

<tr>
	<td>Password:</td>
	<td><input type="password" name="password" size="40" id="password" class="validate"></td>
</tr>

<tr>
	<td>Permissions: </td>
	<td>
	<select name="access_level">
		<option value="2">Administrator</option>
		<option value="1">Manager</option>
		<option value="0" selected>User</option>
	</select>	
	</td>
</tr>



</table>

<br>
<input type="submit" value="Add User">

<form>