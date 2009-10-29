{*
    Copyright (C) 2009, All Rights Reserved.

    This file is part of RPInventory.

    RPInventory is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    RPInventory is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with RPInventory.  If not, see <http://www.gnu.org/licenses/>.

*}
<div class="TopOfTable">
	<span class="TopOfTable">
		<a href="addUser.php">Add new user</a>
	</span>
</div>

<div id="filters" class="filters">
	<h3>Search:</h3>
		<input type="text" id="searchField" class="searchField" />	
</div>

<table width="700" border="0" class="itemsTable searchable sortable" cellspacing="0">
	<thead>
		<tr>
			<th width="100">Username</th>
			<th width="100">Access</th>
			<th width="150">Email</th>
			<th width="150">Actions</th>		
		</tr>
	</thead>
	<tbody>
		{section name=userLoop loop=$users}
		<tr{cycle values=" class=\"alt\","}>
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
	
			<td align="center"><a href="mailto:{$users[userLoop]->email}">{$users[userLoop]->email}</a></td>
	
			<td align="center"><a href="editUser.php?id={$users[userLoop]->id}">Edit</a> or <input type="button" class="button" onclick="confirmation('Are you sure you want to delete user {$users[userLoop]->username} ?','deleteUser.php?id={$users[userLoop]->id}')" value="Delete User"></td>
		</tr>
		{/section}	
	</tbody>
</table>
