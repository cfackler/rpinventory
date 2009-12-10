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

<form id="AjaxForm" name="addBusiness" action="insertBusiness.php" onsubmit="return ValidateForm()" METHOD="post">
    <div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
    <h3 class="ui-widget-header ui-corner-all">Add Business</h3>
    <table width="410">
      <tr>
        <td>Company Name: </td>
        <td><input type="text" name="company" id="company" class="validate" size="40" onchange="sendValidateRequest('company')" /></td>
      </tr>

      <tr>
        <td>Address: </td>
        <td><input type="text" name="address" id="address" class="validate" size="40" /></td>
      </tr>

      <tr>
        <td>Address 2: </td>
        <td><input type="text" name="address2" id="address2" size="40" /></td>
      </tr>

      <tr>
        <td>City: </td>
        <td><input type="text" name="city" id="city" class="validate" size="40" /></td>
      </tr>

      <tr>
        <td>State: </td>
        <td><input type="text" name="state" id="state" class="validate" size="10" /></td>
      </tr>

      <tr>
        <td>Zip Code: </td>
        <td><input type="text" name="zip" id="zip" class="validate" size="10" /></td>
      </tr>

      <tr>
        <td>Phone Number: </td>
        <td><input type="text" name="phone" id="phone" class="validate" size="20" /></td>
      </tr>

      <tr>
        <td>Fax Number: </td>
        <td><input type="text" name="fax" id="fax" size="20" /></td>
      </tr>

      <tr>
        <td>E-mail: </td>
        <td><input type="text" name="email" id="email" size="40" /></td>
      </tr>

      <tr>
        <td>Website: </td>
        <td><input type="text" name="website" id="website" size="40" /></td>
      </tr>

    </table>

    <br>
    <input type="submit" value="Add" />
  </div>
</form>
