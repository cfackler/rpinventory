{if $authority>1}
    <a href="addPurchase.php">Add a purchase</a>
    <table width="800" border="0" class="itemsTable" cellspacing="0">
    	<tr>		
		<th width="150">Items</th>
		<th>Company Name</th>
		<th>Date</th>
		<th>Total Cost</th>
	</tr>

    {section name=itemLoop loop=$items}
    <tr{cycle values=" class=\"alt\","}>

	<td><a href="viewItems.php?id={$items[itemLoop]->purchase_id}></td>
	<td>{$items[itemLoop]->company_name}</td>
	<td>{$items[itemLoop]->purchase_date}</td>
	<td>${$items[itemLoop]->total_price}</td>
    </tr>
    {/section}	


    </table>
{else}
    <h3>Purchases</h3>

    <p>Please login if you wish to view information about purchases.</p>
{/if}