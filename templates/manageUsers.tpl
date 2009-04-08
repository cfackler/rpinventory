{*
    Copyright (C) 2008, All Rights Reserved.

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
<div class="TopOfTable"><span class="TopOfTable">
<h3>Users</h3>
<a href="addUser.php">Add new user</a>
</span></div>

<table width="900" border="0" class="itemsTable" cellspacing="0">
	<tr>
		
		{* Name *}
		<th>
		{* Default *}
		{if !isset($sort) }
		  <a class="tableHeaderLink" href="?sort=name&sortdir=DESC">
		    Name
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'name' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="?sort=name&sortdir=DESC">
		    Name
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'name' && $sortdir == 'DESC'}
		  <a class="tableHeaderLink" href="?sort=name">
		    Name
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="?sort=name">
		    Name
		  </a>
		{/if}
		</th>
		
		{* Username *}
		<th width="100">
		{if isset($sort) && $sort == 'username' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="?sort=username&sortdir=DESC">
		    Username
		    <img src="images/sortTriangleUp.png" />
      </a>
    {elseif isset($sort) && $sort == 'username' && $sortdir=='DESC'}
      <a class="tableHeaderLink" href="?sort=username">
		    Username
		    <img src="images/sortTriangleDown.png" />
      </a>
    {else}
      <a class="tableHeaderLink" href="?sort=username">
		    Username
      </a>
    {/if}
    </th>
    
    {* Access *}
		<th width="100">
		{if isset($sort) && $sort == 'access_level' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="?sort=access_level&sortdir=DESC">
		    Access
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'access_level' && $sortdir == 'DESC'}
		  <a class="tableHeaderLink" href="?sort=access_level">
		    Access
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="?sort=access_level">
		    Access
		  </a>
		{/if}
		</th>
		
		{* RIN *}
		<th width="100">
		{if isset($sort) && $sort =='rin' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="?sort=rin&sortdir=DESC">
		    RIN
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort =='rin' && $sortdir=='DESC'}
		  <a class="tableHeaderLink" href="?sort=rin">
		    RIN
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="?sort=rin">
		    RIN
		  </a>
		{/if}
		</th>
		
		{* Email *}
		<th width="150">
		{if isset($sort) && $sort == 'email' && !isset($sortdir)}
		  <a class="tableHeaderLink" href="?sort=email&sortdir=DESC">
		    Email
		    <img src="images/sortTriangleUp.png" />
		  </a>
		{elseif isset($sort) && $sort == 'email' && $sortdir=='DESC'}
		  <a class="tableHeaderLink" href="?sort=email">
		    Email
		    <img src="images/sortTriangleDown.png" />
		  </a>
		{else}
		  <a class="tableHeaderLink" href="?sort=email">
		    Email
		  </a>
		{/if}
		</th>
		
		{* Actions does not need to be a sorting column *}
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
	
	<td align="center"><a href="editUser.php?id={$users[userLoop]->id}">Edit</a> or <input type="button" class="button" onclick="confirmation('Are you sure you want to delete user {$users[userLoop]->username} ?','deleteUser.php?id={$users[userLoop]->id}')" value="Delete User"></td>
</tr>
{/section}	


</table>