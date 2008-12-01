{*
    Copyright (C) 2008, All Rights Reserved.

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
    along with Foobar.  If not, see <http://www.gnu.org/licenses/>.

*}

<h3>View Address</h3>

<table width="400">
       <tr> 
	    <td>Company Name:</td>
	    <td>{$address->company_name}</td>
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


