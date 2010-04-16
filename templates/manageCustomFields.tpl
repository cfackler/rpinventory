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

<div id="controlsTop" class="ui-widget-smaller ui-widget-content ui-corner-all controls">
    <div class="right" style="padding-top: 18px; padding-bottom: 19px;"> 
        <a id="addCustomField" class="ui-state-default ui-corner-all button" title="Add Custom Field" href="addCustomField.php">
            <span class="ui-icon ui-icon-circle-plus"></span>
            <span class="buttonText">Add Custom Field</span>
        </a>
    </div>
</div>
{if $emptyTable == TRUE}
    <div style="padding: 10px;" class="ui-widget-content ui-widget ui-corner-all">
        <p style="font-weight: bold">No custom fields defined.</p>
    </div>
{else}
    <table width="800" id="itemsTable" class="itemsTable searchable ui-widget" cellspacing="0">
        <thead class="ui-widget-header">
            <tr>
                <th width="300">Field Name</th>
                <th width="150">Field Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="ui-widget-content">
            {section name=fieldLoop loop=$fields}
            <tr {cycle values=" class=\"alt\","}>
                <td>{$fields[fieldLoop]->field_name}</td>
                <td>{$fields[fieldLoop]->field_type_name}</td>
                <td align="center">
                    <a href="editField.php?id={$fields[fieldLoop]->field_id}" class="ui-state-default ui-corner-all button">
                        <span class="ui-icon ui-icon-circle-arrow-w"></span>
                        <span class="buttonText">Edit</span>
                    </a>
                    &nbsp;
                    <a class="ui-state-default ui-corner-all button" onclick="confirmation('Are you sure you want to delete field {$fields[fieldLoop]->field_name} ?','deleteCustomField.php?id={$fields[fieldLoop]->field_id}')">
                        <span class="ui-icon ui-icon-circle-close"></span>
                        <span class="buttonText">Delete</span>
                    </a>
                </td>
            </tr>
            {/section}
        </tbody>
    </table>
{/if}
