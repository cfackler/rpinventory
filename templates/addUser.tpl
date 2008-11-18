<form name="storeTransaction" action="addUserRecord.php" METHOD="post">

<h3>Add User</h3>

<table width="400">


<tr>
	<td>Username: </td>
	<td><input type="text" name="username" size="40"></td>
</tr>

<tr>
	<td>Password:</td>
	<td><input type="password" name="password" size="40"></td>
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
