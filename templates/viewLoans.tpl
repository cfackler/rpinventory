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


<table width="600" border="1">
	<tr>
		<th>Item</th>
		<th>Starting Condition</th>
		<th>Borrower</th>
		<th>Loan Date</th>
		<th>Return Date</th>
	</tr>

{section name=itemLoop loop=$items}
<tr>

	<td>{$items[itemLoop]->description}</td>
	<td>{$items[itemLoop]->starting_condition}</td>
	<td>{$items[itemLoop]->username}</td>
	<td>{$items[itemLoop]->issue_date}</td>
	<td>{$items[itemLoop]->return_date}</td>
</tr>
{/section}	


</table>