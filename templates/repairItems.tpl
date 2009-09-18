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

<form name="editItem" action="insertRepairRecord.php" onsubmit="return ValidateForm()" METHOD="post">
<span class="TopOfTable">
	<h3>Repair Items</h3>
</span>

<input type="hidden" name="count" size="40" value="{$itemCount}">
{section name=num loop=$items}

<table width="500">

<input type="hidden" name="inventory_id{$smarty.section.num.index}" size="40" value="{$items[num]->inventory_id}">

<tr>
	<td>Item:</td>
	<td>{$items[num]->description}</td>
</tr>

<tr>
	<td>Repair Description:</td>
	<td><input type="text" name="desc{$smarty.section.num.index}" size="40" id="description" class="validate"></td>
</tr>

<tr>
	<td>Cost: </td>
	<td><input type="text" name="cost{$smarty.section.num.index}" size="10" id="cost" class="validate"></td>
</tr>

<tr>
	<td>Date: </td>
	<td>
		{html_select_date start_year="-3" end_year="+2" class="dropDown" prefix=$smarty.section.num.index} 
	<td>
</tr>

<tr>
	<td>Business: </td>
	<td>
	
	<select class="dropDown" id="business_id" name="businessId{$smarty.section.num.index}" onChange="OnChange('business_id', 'newBusiness')">
	{section name=biz loop=$businesses}
		<option value="{$businesses[biz]->business_id}">
			{$businesses[biz]->company_name}
		</option>
	{/section}
    	<option value="-1">
			Add a New Business
		</option>
	</select>
	
	</td>
</tr>
	<tr>
    {if $numBusinesses > 0 }
		<table id="newBusiness" style="display:none;padding-left:1cm">	
    {else}
        <table id="newBusiness" style="padding-left:1cm">
    {/if}

     	 	<tr>
			<td>Company Name:</td>
			<td><input type="text" name="company" size="30"></td>
     	 	</tr>

     	 	<tr>
			<td>Address:</td>
			<td> <input type="text" name="address" size="30"></td>
     	 	</tr>

     	 	<tr>
			<td>Address 2:</td>
			<td><input type="text" name="address2" size="30"></td>
     	 	</tr>

     	 	<tr>
			<td>City: </td>
			<td><input type="text" name="city" size="30"></td>
     	 	</tr>

     	 	<tr>
			<td>State: </td>
			<td><input type="text" name="state" size="10"></td>
     	 	</tr>

     	 	<tr>
			<td>Zip Code: </td>
			<td><input type="text" name="zip" size="10"></td>
     	 	</tr>

     	 	<tr>
			<td>Phone Number: </td>
			<td><input type="text" name="phone" size="20"></td>
     	 	</tr>

     	 	<tr>
			<td>Fax Number: </td>
			<td><input type="text" name="fax" size="20"></td>
     	 	</tr>

     	 	<tr>
			<td>E-mail: </td>
			<td><input type="text" name="email" size="30"></td>
     	 	</tr>

     	 	<tr>
			<td>Website: </td>
			<td><input type="text" name="website" size="30"></td>
     	 	</tr>
		</table>
	</tr>


</table>

<br>
<br>

{/section}

<br>
<input type="submit" value="Repair">

<form>
