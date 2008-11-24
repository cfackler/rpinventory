Show:

{if $filter != "all"}
	<a href="viewLoans.php">All</a>
{else}
	<b>All </b>
{/if}
|
{if $filter != "outstanding"}
	<a href="viewLoans.php?view=outstanding">Outstanding</a>
{else}
	<b>Outstanding </b>
{/if}
|
{if $filter != "returned"}
	 <a href="viewLoans.php?view=returned">Returned</a>
{else}
	<b>Returned </b>
{/if}
<br>
<br>


<table width="800" border="0" class="itemsTable" cellspacing="0">
	<tr>
		<th width="250">Item</th>
		<th>Starting Condition</th>
		<th>Borrower</th>
		<th>Loan Date</th>
		<th width="100">Return Date</th>
	</tr>

{section name=itemLoop loop=$items}
<tr{cycle values=" class=\"alt\","}>

	<td>{$items[itemLoop]->description}</td>
	<td>{$items[itemLoop]->starting_condition}</td>
	<td>{$items[itemLoop]->username}</td>
	<td>{$items[itemLoop]->issue_date}</td>
	<td align="center">
	{if $items[itemLoop]->return_date == NULL && $authority >= 1}
		<a href="returnItem.php?id={$items[itemLoop]->loan_id}">Return</a>
	{elseif $items[itemLoop]->return_date == NULL}
		Out
	{else}
		{$items[itemLoop]->return_date}
	{/if}
	
	</td>
</tr>
{/section}	


</table>