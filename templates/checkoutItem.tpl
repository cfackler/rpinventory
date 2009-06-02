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

<form id="AjaxForm" name="checkoutItem" action="insertCheckoutRecord.php" onsubmit="return ValidateForm()" METHOD="post">

<h3>Checkout Items</h3>

{if $loanedOut == true }
<h4>The following item(s) have already been taken:</h4>

<ul>
{section name=out loop=$itemsOut}
<li>{$itemsOut[out]}</li>
{/section}
</ul>




{else}
<table width="500">

<input type="hidden" name="inventory_ids" size="40" value="{$idString}">

<tr>
	<td valign="top">Items: </td>
	<td>
	
	
		<ul>
			{section name=items loop=$itemDesc}
			<li style="position: relative; left: -25px">{$itemDesc[items]}</li>
			{/section}
		</ul>
	
	</td>
</tr>

<tr>
	<td>Time Taken: </td>
	<td>
		 <input id="time_taken" name="time_taken" class="validate" type="text" value="{$dateTime}"/>
	</td>
</tr>


<tr>
	<td>Checkout To: </td>
	<td>
	
	<input id="username" name="username" class="validate" type="text" onkeyup="checkUsername()" autocomplete="off"/>
	
	</td>
</tr>
<tr>
	<td />
	<td>
	
		<div id="userAutoComplete" style="display:none"></div>
	
	</td>
</tr>

<tr>
	<td>Event Name: </td>
	<td>
		<input id="event_name" name="event_name" class="validate" type="text" />
	</td>
</tr>

<tr>
	<td>Event Location: </td>
	<td>
		<input id="event_location" name="event_location" class="validate" type="text" />
	</td>
</tr>


<tr>
	<td valign="top">Address</td>
	<td valign="top">
		<table width="350">
		<tr>
			<td>Use old address:</td>
			<td><input type="checkbox" id="useOld" name="useOld" onchange="useAddress()"></td>
		</tr>
		<tr>
			<td>Address:</td>
			<td><input type="text" name="address" id="address" class="validate" value=""></td>
		</tr>
		<tr>
			<td>Address2:</td>
			<td><input type="text" name="address2" id="address2" value=""></td>
		</tr>
		<tr>
			<td>City:</td>
			<td><input type="text" name="city" id="city" class="validate" value=""></td>
		</tr>
		<tr>
			<td>State:</td>
			<td><input type="text" name="state" id="state" class="validate" value=""></td>
		</tr>
		<tr>
			<td>Zipcode:</td>
			<td><input type="text" name="zipcode" id="zipcode" class="validate" value=""></td>
		</tr>
		<tr>
			<td>Phone:</td>
			<td><input type="text" name="phone" id="phone" class="validate" value=""></td>
		</tr>
		</table>

	 </td>
</tr>

</table>

<br>

<input type="submit" value="Checkout">
{/if}


</form>
