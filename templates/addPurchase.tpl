{*
  Copyright (C) 2010, All Rights Reserved.

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
  <form id="AjaxForm" name="purchaseItem" action="insertPurchaseRecord.php" onsubmit="return ValidateForm()" METHOD="post">
    <div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
      <h3 class="ui-widget-header ui-corner-all">Insert Inventory</h3>
      {$tooltip.helpDiv}

      <input type="hidden" name="count" id="count" value="1">

      <input type="checkbox" name="ignoreBusiness" id="ignoreBusiness" onclick="hideBusiness()"/>
      <label for="ignoreBusiness">Ignore Business Information</label>
      {$tooltip.ignoreBusiness}
      <br /><br />

      <table>
        <tr id="businessInformation">
          <td>Purchased	From:</td>

          <td>
            <select  id="business_id" name="business_id" onChange="OnChange('business_id', 'newBusiness')" class="validate_cond">
              <option value="-1">Select a Business</option>
              {section name=bus loop=$businesses}
              <option value="{$businesses[bus]->business_id}">
                {$businesses[bus]->company_name}
              </option>
              {/section}

              <option value="newBusiness">
                Add a New Business
              </option>
            </select>
            <span id="business_result" style="display:none"></span>
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
                <td><input type="text" name="address2" id="address2" size="30"></td>
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
                <td><input type="text" name="fax" id="fax" size="20"></td>
              </tr>

              <tr>
                <td>E-mail: </td>
                <td><input type="text" name="email" id="email" size="30"></td>
              </tr>

              <tr>
                <td>Website: </td>
                <td><input type="text" name="website" id="website" size="30"></td>
                <td><input type="button" value="Save Business" onclick="saveBusiness('business_result', 'business_id', 'newBusiness', 'company', 'address', 'address2', 'city', 'state', 'zip', 'phone', 'fax', 'email', 'website');" /></td>
              </tr>
            </table>
          </td>
        </tr>

        <tr>
          <td>
            Date:
          </td>
          <td>
            {html_select_date start_year="-3" end_year="+2"	}
          </td>
        </tr>

        <tr>
          <td>
            Total Value of Purchase: 
          </td>
          <td>
            <input type="text" name="total_cost" value="0.00" id="total_cost" class="validate" readonly="readonly" />
          </td>
        </tr>
        <tr>
          <td>
            Miscellaneous Costs:
          </td>
          <td>
            <input type="text" name="misc_cost" value="0.00" title="0.00" id="misc_cost" class="autoClear validate" onchange="updateTotal('misc_cost')" />
          </td>
        </tr>
      </table>

      <br />

      <div id="itemTable">
        <div id="item-0" class="item">
          <table>
            <tr>
              <td>Item Description: </td>
              <td><input type="text" name="desc-0" size="40" id="description-0" class="validate"></td>
            </tr>

            <tr>
              <td>Value: </td>
              <td><input type="text" name="value-0" id="value-0" class="value validate" onchange="updateTotal('value-0')"></td>
            </tr>

            {section name=field loop=$custom_fields}
                {assign var=field_id value=$custom_fields[field]->field_id}
                <tr>
                    <td>{$custom_fields[field]->field_name}:</td>
                    <td><input type="text" name="field-0-{$custom_fields[field]->field_id}" value="{$default_field_values[$field_id]}" class="validate" /></td>
                </tr>
            {/section}

            <tr>
              <td valign="top">Category: </td>
              <td>
                <select multiple="multiple" id="category-0" name="category-0[]" class="category_select" title="Please select a category">
                  {$category_options}
                </select>				
              </td>
              <td valign="top">
                <span id="category_notification-0" name="category_notification-0" class="notification"><a id="add_category_button-0" class="ui-state-default ui-corner-all button add_category_button">
                  <span class="ui-icon ui-icon-plus"><!-- --></span>
                  <span class="buttonText">Add Category</span>
                </a></span>
              </td>
            </tr>

            <tr>
              <td>Condition: </td>
              <td>
                <select  name="condition-0" id="condition-0">
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
                <select id="location-0" name="location-0" class="location_select">
                  {$locations}
                </select>
              </td>

              <td>
                <span id="location_notification-0" class="notification">
                  <a id="add_location_button-0" class="ui-state-default ui-corner-all button add_location_button">
                    <span class="ui-icon ui-icon-plus"><!-- --></span>
                    <span class="buttonText">Add Location</span>
                  </a>
                </span>
              </td>
            </tr>


          </table>
        </div>
        <br />
      </div>
      <div>
        <td><input type="button" onClick="addItemField();" value="Add Item">
          <input type="button" id="removeButton" style="display:none;" onClick="removeItemField();" value="Remove Last Item">
        </td>
        <td><!-- --></td>
      </div>


      <br />
      <input type="submit" value="Purchase">
    </div>
  </form>
