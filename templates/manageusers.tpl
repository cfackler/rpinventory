<h3><a href="addUser.php">Add new user</a></h3>

<table width="500" border="1">
	<tr>
		<th>Username</th>
		<th>Access</th>
		<th width="162">Actions</th>
	</tr>

{section name=userLoop loop=$users}
<tr>

	<td>{$users[userLoop]->username}</td>
	<td>
	{if $users[userLoop]->access_level == 2}
		Administrator
	{elseif $users[userLoop]->access_level == 1}
		Manager
	{else}
		User
	{/if}
		
	</td>
	<td align="center"><a href="edituser.php?id={$users[userLoop]->id}">Edit User</a> | <a href="deleteUser.php?id={$users[userLoop]->id}">Delete User</a></td>
</tr>
{/section}	


</table>