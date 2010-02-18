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

  <form name="storeTransaction" action="addUserRecord.php" onsubmit="return ValidateForm()" METHOD="post">
    <div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
      <h3 class="ui-widget-header ui-corner-all">Add User</h3>


      <table width="400">

        <tr>
          <td>Username: </td>
          <td><input type="text" name="username" size="40" id="username" class="validate"></td>
        </tr>

        <tr>
          <td>Password:</td>
          <td><input type="password" name="password" size="40" id="password" class="validate"></td>
        </tr>

        <tr>
          <td>Email: </td>
          <td><input type="text" name="email" size="40" id="email" class="validate"></td>
        </tr>

        <tr>
          <td>Permissions: </td>
          <td>
            <select name="access_level">
              <option value="1">User</option>
              <option value="2">Manager</option>
              {if $auth > 2}
                <option value="3">Administrator</option>
              {/if}
            </select>	
          </td>
        </tr>



      </table>

      <br />
      <input type="submit" value="Add User" />
    </div>
    <form>
