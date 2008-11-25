{if $authority>1}
    <table width="800" border="0" class="itemsTable" cellspacing="0">
    	<tr>		
		<th width="200">Item</th>
		<th>Company Name</th>
		<th>Date</th>
		<th>Cost</th>
		<th width="250">Description</th>
	</tr>

    {section name=itemLoop loop=$items}
    <tr{cycle values=" class=\"alt\","}>

	<td>{$items[itemLoop]->inv_description}</td>
	<td><a href="viewAddress.php?id={$items[itemLoop]->business_id}">{$items[itemLoop]->company_name}</td>
	<td>{$items[itemLoop]->repair_date}</td>
	<td>${$items[itemLoop]->repair_cost}</td>
	<td>{$items[itemLoop]->rep_description}</td>
    </tr>
    {/section}	


    </table>
{else}
    <h3>Repairs</h3>

    <p>Please login if you wish to view information about repairs.</p>
{/if}