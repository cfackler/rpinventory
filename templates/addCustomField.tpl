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

{include file=notificationArea.tpl}

<div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
    <form name="addCustomField" action="insertCustomField.php" onsubmit="return ValidateForm()" method="post">
        <table width="400">
            <tr>
                <td>Field Name: </td>
                <td><input type="text" name="fieldName" size="40" id="fieldName" class="validate" /></td>
            </tr>
            <tr>
                <td>Field Type: </td>
                <td>
                    <select class="dropDown" name="dataType">
                        <option value="integer">Integer</option>
                        <option value="string">Word</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Add Field" /></td>
            </tr>
        </table>
    </form>
</div>
