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

  <form name="makeSummary" id="checkBoxForm" action="makeSummary.php" onsubmit="return ValidateForm()" METHOD="post">
    <div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
      <h3 class="ui-widget-header ui-corner-all">Select items to be included</h3>

      <ul class="nobullets">
        <li>
          <input type="checkbox" name="inventory" id="inventory" value="Inventory" />
          <label for="inventory">Inventory</label>
        </li>
        <li>
          <input type="checkbox" name="loans" id="loans" value="Loans" />
          <label for="loans">Loans</label>
        </li>
        <li>
          <input type="checkbox" name="checkouts" id="checkouts" value="Checkouts" />
          <label for="checkouts">Checkouts</label>
        </li>
        <li>
          <input type="checkbox" name="repairs" id="repairs" value="Repairs" />
          <label for="repairs">Repairs</label>
        </li>
        <li>
          <input type="checkbox" name="purchases" id="purchases" value="Purchases" />
          <label for="purchases">Purchases</label>
        </li>
        <li>
          <input type="checkbox" name="businesses" id="businesses" value="Businesses" />
          <label for="businesses">Businesses</label>
        </li>
        <li>
          <input type="checkbox" name="borrowers" id="borrowers" value="Borrowers" />
          <label for="borrowers">Borrowers</label>
        </li>
        <li>
          <input type="checkbox" name="users" id="users" value="Users" />
          <label for="users">Users</label>
        </li>
        <li>
          <input type="checkbox" name="locations" id="locations" value="Locations" />
          <label for="locations">Locations</label>
        </li>
        <br />
        <li class="indent">
          <input type="checkbox" name="selectallnone" id="selectallnone" value="selectallnone" onClick="selectAllNone(this, 'checkBoxForm');"/>
          <label for="selectallnone">Select All/None</label>
        </li>
      </ul>
      <br />
      <table>
        <tr>
          <td><label for="startdate">Starting Date:</label> </td>
          <td>{html_select_date start_year="-5" end_year="+0"
            prefix="start_"}
          </td>
        </tr>
        <tr>
          <td><label for="enddate">Ending Date:</label></td>
          <td>{html_select_date start_year="-5" end_year="+0"
            prefix="end_"}
          </td>
        </tr>
      </table>


      <br />

      <input type="submit" value="Create Summary">
    </div>
  </form>
