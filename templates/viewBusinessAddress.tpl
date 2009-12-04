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

<div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">

  <table class="itemsTable ui-widget ui-corner-all" width="400" cellspacing="0">
    <thead class="ui-widget-header">
      <tr>
        <th colspan="2">
          {$address->company_name}
        </th>
      </tr>
    </thead>
    <tbody class="ui-widget-content">
      <tr> 
        <td><label>Company Name:</label></td>
        <td><label>{$address->company_name}</label></td>
      </tr>

      <tr class="alt">
        <td><label>Address:</label></td>
        <td><label>{$address->address}</label></td>
      </tr>

      {if $address->address2 != ""}
      <tr>
        <td></td>
        <td><label>{$address->address2}&nbsp;</label></td>
      </tr>

      <tr class="alt">
        <td><label>City:</label></td>
        <td><label>{$address->city}</label></td>
      </tr>

      <tr>
        <td><label>State:</label></td>
        <td><label>{$address->state}</label></td>
      </tr>

      <tr class="alt">
        <td><label>Zip Code:</label></td>
        <td><label>{$address->zipcode}</label></td>
      </tr>

      <tr>
        <td><label>Phone Number:</label></td>
        <td><label>{$address->phone}</label></td>
      </tr>
      {else}

      <tr>
        <td><label>City:</label></td>
        <td><label>{$address->city}</label></td>
      </tr>

      <tr class="alt">
        <td><label>State:</label></td>
        <td><label>{$address->state}</label></td>
      </tr>

      <tr>
        <td><label>Zip Code:</label></td>
        <td><label>{$address->zipcode}</label></td>
      </tr>

      <tr class="alt">
        <td><label>Phone Number:</label></td>
        <td><label>{$address->phone}</label></td>
      </tr>
      {/if}
    </tbody>
  </table>

  <br/>

  <a href="javascript:history.go(-1)">Go back</a>
</div>