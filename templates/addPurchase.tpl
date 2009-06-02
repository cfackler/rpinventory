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

<h3>Create Purchase</h3>

<form id="AjaxForm" name="purchaseItem" action="insertPurchaseRecord.php" onsubmit="return ValidateForm()" METHOD="post">

  <input type="hidden" name="count" id="count" value="1">

  <ul style="list-style-type:none">
    <input type="checkbox" name="ignoreBusiness" id="ignoreBusiness" onclick="hideBusiness()"/>
    <label for="ignoreBusiness">Ignore Business Information</label>
    
    <br />

    <span id="businessInformation">
    <br />
    <li>
        <table><tr>
	<td>Purchased	From:</td>
      
	<td><select class="dropDown" id="business_id" name="business_id" onChange="OnChange('business_id', 'newBusiness')" class="validate_cond">
	<option value="-1">Select Business</option>
	{section name=bus loop=$businesses}
	<option value="{$businesses[bus]->business_id}">
	  {$businesses[bus]->company_name}
	</option>
	{/section}

	<option value="newBusiness">
	  Add a New Business
	</option>
      </select>
      </td>
     </tr>
     <tr id="newBusiness" style="display:none;">
      <td colspan="2">
      <table style="padding-left: 1cm">	
     	<tr>
	  <td>Company Name:</td>
	  <td><input type="text" name="company" size="30" id="company" class="validate_cond_bus" onchange="sendValidateRequest('company')"></td>
     	</tr>

     	<tr>
	  <td>Address:</td>
	  <td> <input type="text" name="address" size="30" id="address" class="validate_cond_bus"></td>
     	</tr>

     	<tr>
	  <td>Address 2:</td>
	  <td><input type="text" name="address2" size="30"></td>
     	</tr>

     	<tr>
	  <td>City: </td>
	  <td><input type="text" name="city" size="30" id="city" class="validate_cond_bus"></td>
     	</tr>

     	<tr>
	  <td>State: </td>
	  <td><input type="text" name="state" size="10" id="state" class="validate_cond_bus"></td>
     	</tr>

     	<tr>
	  <td>Zip Code: </td>
	  <td><input type="text" name="zip" size="10" id="zip" class="validate_cond_bus"></td>
     	</tr>

     	<tr>
	  <td>Phone Number: </td>
	  <td><input type="text" name="phone" size="20" id="phone" class="validate_cond_bus"></td>
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
     </td>
    </tr>
    <tr>
      <td>
	Date:
      </td>
      <td>
	{html_select_date start_year="-3" end_year="+2"	class="dropDown"}
     </td>
    </tr>

    <tr>
     <td>
      Total Value of Purchase: 
     </td>
     <td>
      <input type="text" name="total_cost" value="" id="total_cost" class="validate">
     </td>
    </tr>
    </table>
    </span>

    <br />

    <div id="itemTable">
      <div id="item0">
	<table>
	  <tr>
	    <td>Item Description: </td>
	    <td><input type="text" name="desc0" size="40" id="description0" class="validate"></td>
	  </tr>
	  
	  <tr>
	    <td>Value: </td>
	    <td><input type="text" name="value0" id="value0" class="validate"></td>
	  </tr>
	  
	  <tr>
	    <td>Condition: </td>
	    <td>
	      <select class="dropDown" name="condition0">
		<option value="Excellent">Excellent</option>
		<option value="Good">Good</option>
		<option value="Fair">Fair</option>
		<option value="Poor">Poor</option>
	      </select>
	    </td>
	  </tr>

	  <tr>
	    <td>Location: </td>

	    <td>
	      <select class="dropDown" id="location0" name="location0" onChange="OnChangeDouble('location0', 'newLocation0', 'newDescription0')" onFocus="getLocationOptions(this);">

			{$locations}
		
	      </select>
	    <span id="resultText0"></span>
	    </td>
	  </tr>

	  <tr id="newLocation0" style="display:none">
	    <td>New Location:</td>
	    <td>
	      <input type="text" name="newlocation0" id="newlocation0" size="40" onChange="sendValidateRequest('newlocation0')">
	    </td>
	  </tr>
	  <tr id="newDescription0" style="display:none">
	    <td>Location Description:</td>
	    <td>
	      <input type="text" name="newdescription0" id="newdescription0" size="40">
	    </td>
	    <td><input value="Save Location" type="button" onClick="saveLocation('newlocation0', 'newdescription0', 'resultText0', 'location0', 'newLocation0', 'newDescription0');">
	    </td>
	  </tr>
	</table>
      </div>
    <br />
    </div>
    <div>
      <td><input type="button" class="button" onClick="addItemField();" value="Add Item">
	<input type="button" class="button" id="removeButton" style="display:none;" onClick="removeItemField();" value="Remove Last Item"></td>
      <td></td>
    </div>

    
</ul>
<br />
<input type="submit" value="Purchase">
</form>
