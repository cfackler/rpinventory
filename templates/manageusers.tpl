<h3><a href="addUser.php">Add new user</a></h3>

<table width="900" border="0" class="itemsTable" cellspacing="0">
	<tr>
		<th>Name</th>
		<th width="100">Username</th>
		<th width="100">Access</th>
		<th width="100">RIN</th>
		<th width="150">Email</th>
		<th width="150">Actions</th>
	</tr>

{section name=userLoop loop=$users}
<tr{cycle values=" class=\"alt\","}>
	<td align="center">{$users[userLoop]->name}</td>
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
	
	
	<td align="center">{$users[userLoop]->rin}</td>
	<td align="center">{$users[userLoop]->email}</td>
	
	<td align="center"><a href="edituser.php?id={$users[userLoop]->id}">Edit</a> or <input type="button" onclick="confirmation('Are you sure you want to delete user {$users[userLoop]->username} ?','deleteUser.php?id={$users[userLoop]->id}')" value="Delete User"></td>
</tr>
{/section}	


</table>