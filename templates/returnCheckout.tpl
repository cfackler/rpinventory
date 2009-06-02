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

<form name="returnC1heckoutItem" action="updateCheckoutRecord.php" METHOD="post">
<div class="TopOfTable">
<span class="TopOfTable">
<h3>Return Checkout Item</h3>
</span></div>

<table width="400">

<input type="hidden" name="checkout_id" size="40" value="{$item->checkout_id}">
<input type="hidden" name="inv_id" size="40" value="{$item->inventory_id}">

<tr>
	<td>Description: </td>
	<td>{$item->description}</td>
</tr>


<tr>
	<td>Previous Condition: </td>
	<td>{$item->current_condition}</td>
</tr>

<tr>
	<td>Returned Condition: </td>
	<td>
		<select class="dropDown" name="condition">
			<option value="Excellent"{if $item->current_condition == "Excellent"}selected{/if}>Excellent</option>
			<option value="Good"{if $item->current_condition == "Good"}selected{/if}>Good</option>
			<option value="Fair"{if $item->current_condition == "Fair"}selected{/if}>Fair</option>
			<option value="Poor"{if $item->current_condition == "Poor"}selected{/if}>Poor</option>
		</select>
	</td>
</tr>

<tr>
	<td>Time Taken: </td>
	<td>
		<input type="text" id="time_taken" name="time_taken" value="{$item->time_taken}" disabled="true" />

<tr>
	<td>Time Returned: </td>
	<td>
		<input type="text" id="time_returned" name="time_returned" class="validate" value="{$dateTime}" />
	</td>
</tr>


</table>

<br />

<input type="submit" value="Return">


<form>
