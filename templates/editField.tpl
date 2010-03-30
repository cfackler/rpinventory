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

<form name="editField" action="updateField.php" onsubmit="return ValidateEditForm(this)" method="post">
  <div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
    <h3 class="ui-widget-header ui-corner-all">Edit Field</h3>
    <input type="hidden" value="{$field->field_id}" name="id" />

    <table>
        <tr>
            <td>Field Name:</td>
            <td width="250"><input type="text" name="name" size="40" id="name" value="{$field->field_name}"></td>
        </tr>
    </table>
    <br />
    <input type="submit" value="Edit">
    </div>
</form>
