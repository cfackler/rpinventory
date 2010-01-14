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

  <form name="storeTransaction" action="updateClubRecord.php" onsubmit="return ValidateForm()" METHOD="post">
    <div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
      <h3 class="ui-widget-header ui-corner-all">Edit Club</h3>


      <table width="500">
        <input type="hidden" name="club_id" size="40" value="{$club->club_id}" id="club_id" class="validate" />

        <tr>
          <td>Club Name: </td>
          <td><input type="text" name="club_name" size="40" value="{$club->club_name}" id="club_name" class="validate"></td>
        </tr>

      </table>

      <br>
      <input type="submit" value="Update Club">
    </div>
    <form>
