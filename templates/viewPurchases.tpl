{if $authority>1}
    <a href="addPurchase.php">Add a purchase</a>
    <br />
    <br />
    <table width="800" border="0" class="itemsTable" cellspacing="0">
    	<tr>		
		<th width="150">Items</th>
		<th>Company Name</th>
		<th>Date</th>
		<th>Total Cost</th>
	</tr>

    {section name=itemLoop loop=$purchases}
    <tr{cycle values=" class=\"alt\","}>

	<td>{$purchaseItems[itemLoop]}</td>
	<td>{$purchases[itemLoop]->company_name}</td>
	<td>{$purchases[itemLoop]->purchase_date}</td>
	<td>${$purchases[itemLoop]->total_price}</td>
    </tr>
    {/section}	


    </table>
{else}
    <h3>Purchases</h3>

    <p>Please login if you wish to view information about purchases.</p>
{/if}