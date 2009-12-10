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

  <form name="storeTransaction" action="updateBorrowerRecord.php" onsubmit="return ValidateForm()" METHOD="post">
    <div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
      <h3 class="ui-widget-header ui-corner-all">Edit Borrower</h3>


      <table width="400">

        <input type="hidden" name="id" size="40" value="{$borrower->borrower_id}"/>
        <input type="hidden" name="address_id" size="40" value="{$address_id}"/>

        <tr>
          <td>Name: </td>
          <td><input type="text" name="name" size="40" value="{$borrower->name}" id="name" class="validate"></td>
        </tr>

        <tr>
          <td>RIN: </td>
          <td><input type="text" name="rin" size="40" value="{$borrower->rin}" id="RIN" class="validate"></td>
        </tr>

        <tr>
          <td>Email: </td>
          <td><input type="text" name="email" size="40" value="{$borrower->email}" id="email" class="validate"></td>
        </tr>

        <tr>
          <td>Address:</td>
          <td><input type="text" name="address" size="40" id="address" value="{$address->address}" class="validate"></td>
        </tr>

        <tr>
          <td>Address2:</td>
          <td><input type="text" name="address2" size="40" id="address2" value="{$address->address2}" ></td>
        </tr>

        <tr>
          <td>City:</td>
          <td><input type="text" name="city" size="40" id="city" value="{$address->city}" class="validate"></td>
        </tr>

        <tr>
          <td>State:</td>
          <td><input type="text" name="state" size="40" id="state" value="{$address->state}" class="validate"></td>
        </tr>

        <tr>
          <td>Zipcode:</td>
          <td><input type="text" name="zip" size="40" id="zip" value="{$address->zipcode}" class="validate"></td>
        </tr>

        <tr>
          <td>Phone:</td>
          <td><input type="text" name="phone" size="40" id="phone" value="{$address->phone}" class="validate"></td>
        </tr>


      </table>

      <br>
      <input type="submit" value="Update Borrower">
    </div>
    <form>
