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

{include file=notificationArea.tpl}
  <form name="storeTransaction" id="storeTransaction" action="updateClubRecord.php" onsubmit="return ValidateForm()" METHOD="post">
    <div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
      <h3 class="ui-widget-header ui-corner-all">Edit Club</h3>


      <table width="500">
        <input type="hidden" name="club_id" size="40" value="{$club->club_id}" id="club_id" class="validate" />

        <tr>
          <td>Club Name: </td>
          <td><input type="text" name="club_name" size="40" value="{$club->club_name}" id="club_name" class="validate"></td>
        </tr>

        <tr>
            <td valign="top">Users: </td>
            <td>
                <table class="itemsTable userTable ui-widget ui-corner-all" cellspacing="0">
                    {section name=userLoop loop=$users}
                    <tr {cycle values=" class=\"alt\","}>
                        <td>{$users[userLoop]->username}</td>
                        <td>
                            <input id="userPriv" type="radio" name="curaccess-{$users[userLoop]->user_id}" {if $users[userLoop]->access_level == 1} checked="checked"{/if}/><label for="userPriv">User</label>&nbsp;
                            <input id="adminPriv" type="radio" name="curaccess-{$users[userLoop]->user_id}" {if $users[userLoop]->access_level == 2} checked="checked" {/if}/><label for="adminPriv">Admin</label>
                        </td>
                        <td>
                            <a href="deleteUserClub.php?club_id={$club->club_id}&user_id={$users[userLoop]->user_id}" class="ui-state-default ui-corner-all button">
                                <span class="ui-icon ui-icon-circle-minus"></span>
                                <span class="buttonText">Remove user</span>
                            </a>
                    </tr>
                    {/section}
                </table>
            </td>
        </tr>
        <tr>
            <td/>
            <td>
                <p id="responseMessage"></p>
                <p style="width: 100px" onclick="newUserClubShow();" class="ui-state-default ui-corner-all button">
                    <span class="ui-icon ui-icon-circle-arrow-s"></span>
                    <span class="buttonText">Add new user</span>
                </p>
            </td>
        </tr>

        <tr id="newUser" style="display: none">
            <td/>
            <td>
                <select id="newUserSelect">
                    {section name=usersLoop loop=$newUsers}
                        <option value="{$newUsers[usersLoop]->username}">{$newUsers[usersLoop]->username}</option>
                    {/section}
                </select>
                <br />
                <input type="radio" name="access" id="access1" value="1" checked="checked" /><label for="access1">User </label><input type="radio" name="access" id="access2" value="2" /><label for="access2">Admin</label>
                <p style="width: 100px" onclick="addUserToClub({$club->club_id});" class="ui-state-default ui-corner-all button">
                    <span class="ui-icon ui-icon-circle-plus"></span>
                    <span class="buttonText">Save new user</span>
                </p>

            </td>
        </tr>

        </table>

        <br>
        <a class="ui-corner-all ui-state-default button" onclick="formSubmit('storeTransaction')">
            <span class="ui-icon ui-icon-circle-check"></span>
            <span class="buttonText">Update Club</span>
          </a>
        &nbsp;&nbsp;
        <a href="manageClubs.php" class="ui-corner-all ui-state-default button">
            <span class="ui-icon ui-icon-circle-arrow-w"></span>
            <span class="buttonText">Back to all clubs</span>
        </a>
    </div>
    <form>
