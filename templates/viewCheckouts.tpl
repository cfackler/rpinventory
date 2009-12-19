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

  {if $viewCheckoutId > 0}
  <table class="itemsTable sortable searchable ui-widget ui-corner-all" cellspacing="0">
    <thead class="ui-widget-header">
      <tr>
        <th colspan="2">
          Checkout
        </th>
      </tr>
    </thead>
    <tbody class="ui-widget-content">
      <tr>
        <td>
          <label>Item:</label>
        </td>
        <td>
          <label>{$checkoutObj->description}</label>
        </td>
      </tr>
      <tr class="loanAlt">
        <td>
          <label>Borrower:</label>
        </td>
        <td>
          <label>{$checkoutObj->name}</label>
        </td>
      </tr>
      <tr>
        <td>
          <label>Date Taken:</label>
        </td>
        <td>
          <label>{$checkoutObj->time_taken}</label>
        </td>
      </tr>
      <tr class="loanAlt">
        <td>
          <label>Original Location:</label>
        </td>
        <td>
          <label>{$checkoutObj->location}</label>
        </td>
      </tr>
    </tbody>
  </table>

  <br />

  <a href="javascript:history.go(-1)">Go back</a>
  {else}

  <div id="controlsTop" class="ui-widget-smaller ui-widget-content ui-corner-all controls">
    <div class="left">
      <h3>Search:</h3>
      <input type="text" id="searchField" class="searchField" />
    </div>
    <div class="right">
      {if $filter != "all"}
        <a id="allFilter" class="ui-state-default ui-corner-all button" href="viewCheckouts.php" title="View all checkouts">
            <span class="ui-icon ui-icon-search"></span>
            <span class="buttonText">Show all</span>
        </a>
      {else}
      <a id="allFilter" class="ui-state-active ui-corner-all button" href="viewCheckouts.php" title="View all checkouts">
        <span class="ui-icon ui-icon-search"><!-- --></span>
        <span class="buttonText">Show all</span>
      </a>
      {/if}
      &nbsp;
      {if $filter != "outstanding"}
      <a id="outstandingFilter" class="ui-state-default ui-corner-all button" href="viewCheckouts.php?view=outstanding" title="View outstanding checkouts">
        <span class="ui-icon ui-icon-star"><!-- --></span>
        <span class="buttonText">Show outstanding</span>
      </a>
      {else}
      <a id="outstandingFilter" class="ui-state-active ui-corner-all button" href="viewCheckouts.php?view=outstanding" title="View outstanding checkouts">
        <span class="ui-icon ui-icon-star"><!-- --></span>
        <span class="buttonText">Show outstanding</span>
      </a>
      {/if}
      &nbsp;
      {if $filter != "returned"}
      <a id="returnedFilter" class="ui-state-default ui-corner-all button" href="viewCheckouts.php?view=returned" title="View returned checkotus">
        <span class="ui-icon ui-icon-check"><!-- --></span>
        <span class="buttonText">Show returned</span>
      </a>
      {else}
      <a id="returnedFilter" class="ui-state-active ui-corner-all button" href="viewCheckouts.php?view=returned" title="View returned checkotus">
        <span class="ui-icon ui-icon-check"><!-- --></span>
        <span class="buttonText">Show returned</span>
      </a>
      {/if}
    </div>
  </div>

  <table width="800" border="0" class="itemsTable sortable searchable ui-widget ui-corner-all" cellspacing="0">
    <thead class="ui-widget-header">
      <tr>
        <th width="250">Item</th>
        <th width="175">Starting Condition</th>
        <th width="100">Borrower</th>
        <th width="150">Time Taken</th>
        <th width="120">Return Date</th>
      </tr>
    </thead>
    <tbody class="ui-widget-content">		
      {section name=itemLoop loop=$items}
      <tr{cycle values=" class=\"alt\","}>

      <td>{$items[itemLoop]->description}</td>
      <td>{$items[itemLoop]->starting_condition}</td>
      <td>{$items[itemLoop]->name}</td>
      <td>{$items[itemLoop]->time_taken}</td>
      <td>
        {if $items[itemLoop]->time_returned == NULL && $authority >= 1}
        <a href="returnCheckoutItem.php?id={$items[itemLoop]->checkout_id}">Return</a>
        {elseif $items[itemLoop]->time_returned == NULL}
        Out
        {else}
        {$items[itemLoop]->time_returned}
        {/if}

      </td>
    </tr>
    {/section}	
  </tbody>
</table>

{/if}
