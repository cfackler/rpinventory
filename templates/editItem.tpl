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

<form name="editItem" action="updateItem.php" onsubmit="return ValidateEditForm(this)" METHOD="post">

<span class="TopOfTable">
	<h3>Edit Item</h3>
</span>

<br />

<input type="hidden" name="count" size="40" value="{$itemCount}">

{section name=num loop=$items}

<table width="400">

<input type="hidden" name="inventory_id-{$smarty.section.num.index}" size="40" value="{$items[num]->inventory_id}">

<tr>
	<td>Description:
</td>
	<td><input type="text" name="desc-{$smarty.section.num.index}" size="40" id="description" value="{$items[num]->description}"></td>
</tr>

<tr>
	<td>Value: </td>
	<td><input type="text" name="value-{$smarty.section.num.index}" size="40" id="value" value="{$items[num]->current_value}"></td>
</tr>

<tr>
	<td>Category: </td>
	<td>
		<select name="category-{$smarty.section.num.index}" id="category-{$smarty.section.num.index}">
			{$category_options}
			<option value="-1">
				New Category
			</option>
		</select>
	</td>
</tr>
		

<tr>
	<td>Condition: </td>
	<td>
		<select class="dropDown" name="condition-{$smarty.section.num.index}">
			<option value="Excellent" {if $items[num]->current_condition == "Excellent"}selected{/if}>Excellent</option>
			<option value="Good" {if $items[num]->current_condition == "Good"}selected{/if}>Good</option>
			<option value="Fair" {if $items[num]->current_condition == "Fair"}selected{/if}>Fair</option>
			<option value="Poor" {if $items[num]->current_condition == "Poor"}selected{/if}>Poor</option>
		</select>
	</td>
</tr>

<tr>
	<td>Location: </td>
	<td>
	
	<select class="dropDown" name="location-{$smarty.section.num.index}" id="location-{$smarty.section.num.index}" onChange="OnChangeDouble('location-{$smarty.section.num.index}', 'newLocation-{$smarty.section.num.index}', 'newDescription-{$smarty.section.num.index}')">   
    {section name=loc loop=$locations}
		<option value="{$locations[loc]->location_id}">
			{$locations[loc]->location}
		</option>
    {* If there are no locations, just put a blank option there. *}
    {sectionelse}
  		<option value = "-2">
        </option>
	{/section}
        <option value = "-1">
			New Location
		</option>
        
	</select>
	
	</td>
</tr>
    <tr id="newLocation-{$smarty.section.num.index}" style="display:none">
            <td>New Location:</td>
        <td>
                <input type="text" name="newlocation-{$smarty.section.num.index}" size="40">
        </td>
    </tr>
    <tr id="newDescription-{$smarty.section.num.index}" style="display:none">
            <td>Location Description:</td>
        <td>
                <input type="text" name="newdescription-{$smarty.section.num.index}" size="40">
        </td>
    </tr>
	

</table>

<br>
<br>

{/section}

<br>
<input type="submit" value="Edit">

</form>
