<h3><a href="addUser.php">Add new user</a></h3>

<table width="500" border="1">
	<tr>
		<th>Username</th>
		<th>Access</th>
		<th width="200">Actions</th>
	</tr>

{section name=userLoop loop=$users}
<tr>

	<td align="center">{$users[userLoop]->username}</td>
	<td align="center">
	{if $users[userLoop]->access_level == 2}
		Administrator
	{elseif $users[userLoop]->access_level == 1}
		Manager
	{else}
		User
	{/if}
		
	</td>
	<td align="center"><a href="edituser.php?id={$users[userLoop]->id}">Edit User</a> | <input type="button" onclick="confirmation('Are you sure you want to delete user {$users[userLoop]->username} ?','deleteUser.php?id={$users[userLoop]->id}')" value="Delete User"></td>
</tr>
{/section}	


</table>