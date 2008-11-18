<form name="storeTransaction" action="updateUserRecord.php" METHOD="post">

<h3>Edit User</h3>

<table width="400">

<input type="hidden" name="id" size="40" value="{$user->id}">

<tr>
	<td>Username: </td>
	<td><input type="text" name="username" size="40" value="{$user->username}"></td>
</tr>

<tr>
	<td>Password: (blank for same)</td>
	<td><input type="password" name="password" size="40"></td>
</tr>

<tr>
	<td>Permissions: </td>
	<td>
	<select name="access_level">
		<option value="2" {if $user->access_level == 2}selected{/if}>Administrator</option>
		<option value="1" {if $user->access_level == 1}selected{/if}>Manager</option>
		<option value="0" {if $user->access_level == 0}selected{/if}>User</option>
	</select>	
	</td>
</tr>



</table>

<br>
<input type="submit" value="Update User">

<form>
