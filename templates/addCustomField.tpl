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
        <input type="hidden" name="count" id="count" value="1" />
        <table width="600">
            <tr>
                <td width="100">Field Name: </td>
                <td><input type="text" name="fieldName" size="40" id="fieldName" /></td>
            </tr>
            <tr>
                <td width="100">Default Value: </td>
                <td><input type="text" name="defaultValue" size="40" id="defaultValue" /></td>
            </tr>
            <tr>
                <td>Field Type: </td>
                <td>
                    <select class="dropDown" name="fieldType" id="fieldType" onChange="OnChange('fieldType', 'options')">
                        <option value="integer">Integer</option>
                        <option value="string">String</option>
                        <option value="selection">Selection</option>
                    </select>
                </td>
            </tr>
        </table>
        <div id="options" style="display: none">
            <p>Enter a list of options to choose from:</p>
            <div id="dropDownOptions">
                <div id="option-0" class="item">
                    <table width="600">
                        <tr>
                            <td width="100">Option:</td>
                            <td><input type="text" name="option-0" id="option-0" size="40" /></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div id="controls">
                <p>
                    <input type="button" onClick="addOptionField();" value="Add Option" />
                    <input type="button" id="removeButton" style="display: none" onClick="removeOptionField();" value="Remove Last Option" />
                </p>
            </div>
        </div>

        <br />

        <input type="submit" value="Add Field" />
    </form>
</div>
