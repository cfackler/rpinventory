{if $authority>=1}
	<h3><a href="addBorrower.php">Add new business</a></h3>

	<table width="900" border="0" class="itemsTable" cellspacing="0">
	       <tr>
			<th width="200">Company Name</th>
			<th width="150">Address</th>
			<th width="150">Address</th>
			<th width="100">City</th>
			<th width="20">State</th>
			<th width="100">Zip Code</th>
			<th width="100">Phone Number</th>
			<th width="100">Fax Number</th>
			<th width="100">Email</th>
			<th width="150">Website</th>
		</tr>

	{section name=busLoop loop=$businesses}
		 <tr{cycle values=" class=\"alt\","}>
		 	   <td align="center">{$businesses[busLoop]->company_name}</td>
			   <td align="center">{$businesses[busLoop]->address}</td>
			   <td align="center">{$businesses[busLoop]->address2}</td>
			   <td align="center">{$businesses[busLoop]->city}</td>
			   <td align="center">{$businesses[busLoop]->state}</td>
			   <td align="center">{$businesses[busLoop]->zipcode}</td>
			   <td align="center">{$businesses[busLoop]->phone}</td>
			   <td align="center">{$businesses[busLoop]->fax}</td>
			   <td align="center"><a href="mailto:{$businesses[busLoop]->email}">{$businesses[busLoop]->email}</td>
			   <td align="center"><a href="{$businesses[busLoop]->website}">{$businesses[busLoop]->website}</td>


    		</tr>
	{/section}	


	</table>
{else}
    <h3>Businesses</h3>

    <p>Please login if you wish to view information about businesses.</p>
{/if}