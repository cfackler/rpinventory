<h3>Borrowers</h3>

{if $authority >= 1}
    <table width="800" border="1">
    	<tr>
		<th width="150">Name</th>
		<th width="100">RIN</th>
		<th width="150">Email</th>
		<th>Address</th>
		<th width="100">Phone</th>
	</tr>

	{section name=num loop=$borrowers}
	<tr>
		<td align="center">{$borrowers[num]->name}</td>
		<td align="center">{$borrowers[num]->rin}</td>
		<td align="center">{$borrowers[num]->email}</td>
		
		<td align="center">
			{$borrowers[num]->address}<br>
			
			{if $borrowers[num]->address2 != NULL}
			{$borrowers[num]->address2}<br>
			{/if}
			
			{$borrowers[num]->city}, {$borrowers[num]->state} {$borrowers[num]->zipcode}<br>
		</td>
		
		<td align="center">{$borrowers[num]->phone}</td>
		
	</tr>
	{/section}
    </table>
{else}
    <p>Please login if you wish to view information about borrowers</p>
{/if}