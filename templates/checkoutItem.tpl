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

<form id="AjaxForm" name="checkoutItem" action="insertCheckoutRecord.php" onsubmit="return ValidateForm()" METHOD="post">

  <div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
    <h3 class="ui-widget-header ui-corner-all">Checkout Items</h3>
    {$toolTipHelp.helpDiv}

    {if $loanedOut == true }
    <h4>The following item(s) have already been taken:</h4>

    <ul>
      {section name=out loop=$itemsOut}
      <li>{$itemsOut[out]}</li>
      {/section}
    </ul>
    {else}

    <table width="700">

      <input type="hidden" id="tempUsername" size="50" value=""/>
      <input type="hidden" name="inventory_ids" size="40" value="{$idString}" />
      <input type="hidden" name="borrower_id" id="borrower_id" value="" />
      <input type="hidden" name="club_id" id="club_id" value="{$club_id}" />

      <tr>
        <td valign="top">Items: </td>
        <td>


          <ul>
            {section name=items loop=$itemDesc}
            <li style="position: relative; left: -25px">{$itemDesc[items]}</li>
            {/section}
          </ul>

        </td>
        <td></td>
      </tr>

      <tr>
        <td>Time Taken: </td>
        <td>
          <input id="time_taken" name="time_taken" class="validate" type="text" value="{$dateTime}"/>
        </td>
        <td></td>
      </tr>


      <tr>
        <td>Checkout To: </td>
        <td>
          <input id="username" name="username" class="validate" type="text" onblur="leaveUsername()" onkeyup="checkUsername()" autocomplete="off"/>
          {*$toolTipHelp.checkoutTo*}
        </td>
        <td rowspan="3">
            <div class="ui-state-highlight ui-corner-all notification" id="usernameNotification">Type a username in the system<br/>or<br/>Create a new one.</div>
            <span id="borrowerResult" style="display:none"></span>
        </td>
      </tr>

      <tr>
        <td />
        <td>

          <div id="userAutoComplete" style="display:none; width: 173px"></div>

        </td>
      </tr>

      <tr>
        <td/>
        <td colspan="2">
          <input type="checkbox" id="newBorrower" name="newBorrower" onclick="showNewBorrower()" />
          <span>Create a new borrower</span>
          {*$toolTipHelp.newBorrower*}
          <span id="newBorrowerResult" style="display:none"></span>
        </td>
      </tr>

      <tr id="addNewBorrower" style="display:none;">
        <td colspan="2">
          <table style="padding-left:1cm;">
            <tr>
              <td>Name: </td>
              <td><input type="text" name="name" size="30" id="name"/></td>
            </tr>

            <tr>
              <td>RIN:</td>
              <td><input type="text" name="RIN" size="30" id="RIN"/></td>
            </tr>

            <tr>
              <td>Email: </td>
              <td><input type="text" name="email" size="30" id="email"/></td>
            </tr>

            <tr>
              <td></td>
            </tr>

            <tr>
              <td></td>
            </tr>

            <tr>
              <td>Address:</td>
              <td><input type="text" name="address" size="30" id="newaddress"/></td>
            </tr>

            <tr>
              <td>Address2:</td>
              <td><input type="text" name="address2" size="30" id="newaddress2"/></td>
            </tr>

            <tr>
              <td>City:</td>
              <td><input type="text" name="city" size="30" id="newcity"/></td>
            </tr>

            <tr>
              <td>State:</td>
              <td><input type="text" name="state" size="30" id="newstate"/></td>
            </tr>

            <tr>
              <td>Zipcode:</td>
              <td><input type="text" name="zip" size="30" id="newzip"/></td>
            </tr>

            <tr>
              <td>Phone:</td>
              <td><input type="text" name="phone" size="30" id="newphone"/></td>
              <td><input type="button" value="Save Borrower" onclick="saveBorrower('newBorrowerResult', 'username', 'newBorrower', 'addNewBorrower', 'name', 'RIN', 'email', 'newaddress', 'newaddress2', 'newcity', 'newstate', 'newzip', 'newphone')"/></td>
            </tr>

          </table>
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
