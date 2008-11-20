{if $authority >= 1}
    <table width="800" border="1">
    	<tr>
		<th width="250">User</th>
		{if $authority >= 1}
		    	<th>Name</th>
		    	<th>RIN</th>
		    	<th>Email</th>
		    	<th>Phone</th>
		{/if}
	</tr>

	{section name=itemLoop loop=$items}
	<tr>
		<td>{$items[itemLoop]->borrower_name}</td>
		<td>{$items[itemLoop]->rin}</td>
		<td>{$items[itemLoop]->email}</td>
		<td>{$items[itemLoop]->phone}</td>
	</tr>
	{/section}
    </table>
{/if}
{else}
    <p>Please login if you wish to view information about borrowers</p>
{/else}