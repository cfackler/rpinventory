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
  <div class="ui-widget-smaller ui-widget-content ui-corner-all mainForm">
    <h3 class="ui-widget-header ui-corner-all">View Address</h3>


    <table width="600">
      <tr> 
        <td width="125">Name:</td>
        <td width="475">{$address->name}</td>
      </tr>

      <tr>
        <td>Address:</td>
        <td>{$address->address}</td>
      </tr>

      <tr>
        <td></td>
        <td>{$address->address2}</td>
      </tr>

      <tr>
        <td>City:</td>
        <td>{$address->city}</td>
      </tr>

      <tr>
        <td>State:</td>
        <td>{$address->state}</td>
      </tr>

      <tr>
        <td>Zip Code:</td>
        <td>{$address->zipcode}</td>
      </tr>

      <tr>
        <td>Phone Number:</td>
        <td>{$address->phone}</td>
      </tr>

    </table>

    <br />

    <a href="manageBorrowers.php">Go back</a>
  </div>
