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

<form name="editItem" action="updateItem.php" onsubmit="return ValidateEditForm(this)" method="post">
  <div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
    <h3 class="ui-widget-header ui-corner-all">Edit Item</h3>

    <input type="hidden" name="count" id="count" size="40" value="{$itemCount}">

    {section name=num loop=$items}

    <table width="600">

      <input type="hidden" name="inventory_id-{$smarty.section.num.index}" id="inventory_id-{$smarty.section.num.index}" size="40" value="{$items[num]->inventory_id}">

      <tr>
        <td>Description:
        </td>
        <td width="250"><input type="text" name="desc-{$smarty.section.num.index}" size="40" id="description" value="{$items[num]->description}"></td>
        <td><!-- --></td>
      </tr>

      <tr>
        <td>Value: </td>
        <td><input type="text" name="value-{$smarty.section.num.index}" size="40" id="value" value="{$items[num]->current_value}"></td>
        <td><!-- --></td>
      </tr>

      <tr>
        <td>Category: </td>
        <td id="categoryTD-{$smarty.section.num.index}">
          <select multiple="multiple" name="category-{$smarty.section.num.index}[]" id="category-{$smarty.section.num.index}" class="category_select" title="Please select a category">
            {$category_options}
          </select>
        </td>
        <td>
          <div id="category_notification-{$smarty.section.num.index}" class="category_notification">
            <a id="add_category_button-{$smarty.section.num.index}" class="ui-state-default ui-corner-all button add_category_button">
              <span class="ui-icon ui-icon-plus"><!-- --></span>
              <span class="buttonText">Add Category</span>
            </a>
          </div>
        </td>
      </tr>


      <tr>
        <td>Condition: </td>
        <td>
          <select name="condition-{$smarty.section.num.index}">
            <option value="Excellent" {if $items[num]->current_condition == "Excellent"}selected{/if}>Excellent</option>
            <option value="Good" {if $items[num]->current_condition == "Good"}selected{/if}>Good</option>
            <option value="Fair" {if $items[num]->current_condition == "Fair"}selected{/if}>Fair</option>
            <option value="Poor" {if $items[num]->current_condition == "Poor"}selected{/if}>Poor</option>
          </select>
        </td>
        <td><!-- --><td>
        </tr>

        <tr>
          <td>Location: </td>
          <td>
            <select name="location-{$smarty.section.num.index}" id="location-{$smarty.section.num.index}" class="location_select">
              {section name=loc loop=$locations}
              {if $locations[loc]->location_id == $items[num]->location_id}
              <option value="{$locations[loc]->location_id}" selected="true">
                {else}
                <option value="{$locations[loc]->location_id}">
                  {/if}
                  {$locations[loc]->location}
                </option>
                {/section}
              </select>
            </td>

            <td>
              <span id="location_notification-{$smarty.section.num.index}">
                <a id="add_location_button-{$smarty.section.num.index}" class="ui-state-default ui-corner-all button add_location_button">
                  <span class="ui-icon ui-icon-plus"><!-- --></span>
                  <span class="buttonText">Add Location</span>
                </a>
              </span>
            </td>
          </tr>


        </table>

        <br>
        <br>

        {/section}

        <br>
        <input type="submit" value="Edit">
      </div>
    </form>
