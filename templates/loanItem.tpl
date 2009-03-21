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
    along with RPInventory.  If not, see <http://www.gnu.org/licenses/>.

*}

<form id="AjaxForm" name="loanItem" action="insertLoanRecord.php" onsubmit="return ValidateForm()" METHOD="post">

<h3>Loan Items</h3>

{if $loanedOut == true }
<h4>The following item(s) have already been loaned out:</h4>

<ul>
{section name=out loop=$itemsOut}
<li>{$itemsOut[out]}</li>
{/section}
</ul>




{else}
<table width="400">

<input type="hidden" name="inventory_ids" size="40" value="{$idString}">

<tr>
	<td valign="top">Items: </td>
	<td>
	
	
		<ul>
			{section name=items loop=$itemDesc}
			<li>{$itemDesc[items]}</li>
			{/section}
		</ul>
	
	</td>
</tr>


<tr>
	<td>Date: </td>
	<td>
	
				<select name="months">
                    <option value="1"{if $selectDate.mon == 1} selected{/if}>January</option>
                    <option value="2"{if $selectDate.mon == 2}selected{/if}>February</option>
                    <option value="3"{if $selectDate.mon == 3}selected{/if}>March</option>
                    <option value="4"{if $selectDate.mon == 4}selected{/if}>April</option>
                    <option value="5"{if $selectDate.mon == 5}selected{/if}>May</option>
                    <option value="6"{if $selectDate.mon == 6}selected{/if}>June</option>
                    <option value="7"{if $selectDate.mon == 7}selected{/if}>July</option>
                    <option value="8"{if $selectDate.mon == 8}selected{/if}>August</option>
                    <option value="9"{if $selectDate.mon == 9}selected{/if}>September</option>
                    <option value="10"{if $selectDate.mon == 10}selected{/if}>October</option>
                    <option value="11"{if $selectDate.mon == 11}selected{/if}>November</option>
                    <option value="12"{if $selectDate.mon == 12}selected{/if}>December</option>
                </select>

                <select name="days">
                    <option value="1"{if $selectDate.mday == 1}selected{/if}>1</option>
                    <option value="2"{if $selectDate.mday == 2}selected{/if}>2</option>
                    <option value="3"{if $selectDate.mday == 3}selected{/if}>3</option>
                    <option value="4"{if $selectDate.mday == 4}selected{/if}>4</option>
                    <option value="5"{if $selectDate.mday == 5}selected{/if}>5</option>
                    <option value="6"{if $selectDate.mday == 6}selected{/if}>6</option>
                    <option value="7"{if $selectDate.mday == 7}selected{/if}>7</option>
                    <option value="8"{if $selectDate.mday == 8}selected{/if}>8</option>
                    <option value="9"{if $selectDate.mday == 9}selected{/if}>9</option>
                    <option value="10"{if $selectDate.mday == 10}selected{/if}>10</option>
                    <option value="11"{if $selectDate.mday == 11}selected{/if}>11</option>
                    <option value="12"{if $selectDate.mday == 12}selected{/if}>12</option>
                    <option value="13"{if $selectDate.mday == 13}selected{/if}>13</option>
                    <option value="14"{if $selectDate.mday == 14}selected{/if}>14</option>
                    <option value="15"{if $selectDate.mday == 15}selected{/if}>15</option>
                    <option value="16"{if $selectDate.mday == 16}selected{/if}>16</option>
                    <option value="17"{if $selectDate.mday == 17}selected{/if}>17</option>
                    <option value="18"{if $selectDate.mday == 18}selected{/if}>18</option>
                    <option value="19"{if $selectDate.mday == 19}selected{/if}>19</option>
                    <option value="20"{if $selectDate.mday == 20}selected{/if}>20</option>
                    <option value="21"{if $selectDate.mday == 21}selected{/if}>21</option>
                    <option value="22"{if $selectDate.mday == 22}selected{/if}>22</option>
                    <option value="23"{if $selectDate.mday == 23}selected{/if}>23</option>
                    <option value="24"{if $selectDate.mday == 24}selected{/if}>24</option>
                    <option value="25"{if $selectDate.mday == 25}selected{/if}>25</option>
                    <option value="26"{if $selectDate.mday == 26}selected{/if}>26</option>
                    <option value="27"{if $selectDate.mday == 27}selected{/if}>27</option>
                    <option value="28"{if $selectDate.mday == 28}selected{/if}>28</option>
                    <option value="29"{if $selectDate.mday == 29}selected{/if}>29</option>
                    <option value="30"{if $selectDate.mday == 30}selected{/if}>30</option>
                    <option value="31"{if $selectDate.mday == 31}selected{/if}>31</option>
                </select>
				
				
                <select name="year">
                    <option value="2007"{if $selectDate.year == 2007}selected{/if}>2007</option>
                    <option value="2008"{if $selectDate.year == 2008}selected{/if}>2008</option>
					<option value="2009"{if $selectDate.year == 2009}selected{/if}>2009</option>
                </select>
	
	<td>
</tr>

<tr>
	<td>Loan To: </td>
	<td>
	
	<select id="user_id" name="user_id" class="validate" onchange="sendAddressRequest({$users[usr]->id});">
		<option value="-1">Select User</option>
	{section name=usr loop=$users}
		<option value="{$users[usr]->id}">
			{$users[usr]->username}
		</option>
	{/section}
	</select>
	
	</td>
</tr>

<tr>
	<td valign="top">Address</td>
	<td valign="top">
		<table width="350">
		<tr>
			<td>Use old address:</td>
			<td><input type="checkbox" id="useOld" name="useOld" onchange="useAddress()"></td>
		</tr>
		<tr>
			<td>Address:</td>
			<td><input type="text" name="address" id="address" class="validate" value=""></td>
		</tr>
		<tr>
			<td>Address2:</td>
			<td><input type="text" name="address2" id="address2" value=""></td>
		</tr>
		<tr>
			<td>City:</td>
			<td><input type="text" name="city" id="city" class="validate" value=""></td>
		</tr>
		<tr>
			<td>State:</td>
			<td><input type="text" name="state" id="state" class="validate" value=""></td>
		</tr>
		<tr>
			<td>Zipcode:</td>
			<td><input type="text" name="zipcode" id="zipcode" class="validate" value=""></td>
		</tr>
		<tr>
			<td>Phone:</td>
			<td><input type="text" name="phone" id="phone" class="validate" value=""></td>
		</tr>
		</table>

	 </td>
</tr>

</table>

<br>

<input type="submit" value="Loan">
{/if}


</form>
