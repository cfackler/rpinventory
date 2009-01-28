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

<form name="editItem" action="insertRepairRecord.php" onsubmit="return ValidateForm(this)" METHOD="post">

<h3>Repair Items</h3>

<input type="hidden" name="count" size="40" value="{$itemCount}">

{section name=num loop=$items}

<table width="500">

<input type="hidden" name="inventory_id{$smarty.section.num.index}" size="40" value="{$items[num]->inventory_id}">

<tr>
	<td>Item:</td>
	<td>{$items[num]->description}</td>
</tr>

<tr>
	<td>Repair Description:</td>
	<td><input type="text" name="desc{$smarty.section.num.index}" size="40" id="description" class="validate"></td>
</tr>

<tr>
	<td>Cost: </td>
	<td><input type="text" name="cost{$smarty.section.num.index}" size="10" id="cost" class="validate"></td>
</tr>

<tr>
	<td>Date: </td>
	<td>
	
				<select name="months{$smarty.section.num.index}">
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

                <select name="days{$smarty.section.num.index}">
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
				
				
                <select name="year{$smarty.section.num.index}">
                    <option value="2007"{if $selectDate.year == 2007}selected{/if}>2007</option>
                    <option value="2008"{if $selectDate.year == 2008}selected{/if}>2008</option>
					<option value="2009"{if $selectDate.year == 2009}selected{/if}>2009</option>
                </select>
	
	<td>
</tr>

<tr>
	<td>Business: </td>
	<td>
	
	<select name="businessId{$smarty.section.num.index}">
	{section name=biz loop=$businesses}
		<option value="{$businesses[biz]->business_id}">
			{$businesses[biz]->company_name}
		</option>
	{/section}
	</select>
	
	</td>
</tr>


</table>

<br>
<br>

{/section}

<br>
<input type="submit" value="Repair">

<form>
