<?php /* Smarty version 2.6.22, created on 2009-04-15 15:20:28
         compiled from generateSummary.tpl */ ?>

<div class="TopOfTable">
<span class="TopOfTable">
     <h3>Select Items to be Included</h3>
</span>
</div>

<form name="makeSummary" id="checkBoxForm" action="makeSummary.php" onsubmit="return ValidateForm()" METHOD="post">

<ul class="nobullets">
	<li>
		<input type="checkbox" name="inventory" value="Inventory" />
		<label for="inventory">Inventory</label>
	</li>
	<li>
		<input type="checkbox" name="loans" value="Loans" />
		<label for="loans">Loans</label>
	</li>
	<li>
		<input type="checkbox" name="repairs" value="Repairs" />
		<label for="repairs">Repairs</label>
	</li>
	<li>
		<input type="checkbox" name="purchases" value="Purchases" />
		<label for="purchases">Purchases</label>
	</li>
	<li>
		<input type="checkbox" name="businesses" value="Businesses" />
		<label for="businesses">Businesses</label>
	</li>
	<li>
		<input type="checkbox" name="users" value="Users" />
		<label for="users">Users</label>
	</li>
	<li>
		<input type="checkbox" name="locations" value="Locations" />
		<label for="locations">Locations</label>
	</li>
	<br />
	<li class="indent">
		<input type="checkbox" name="selectallnone" value="selectallnone" onClick="selectAllNone(this, 'checkBoxForm');"/>
		<label for="selectallnone">Select All/None</label>
	</li>
</ul>
<br />
<table>
	<tr>
		<td><label for="startdate">Starting Date:</label> </td>
		<td><input type="text" id="startdate" name="startdate" onClick="removeContents('startdate', 'yyyy-mm-dd')" value="yyyy-mm-dd" class="validate"/></td>
		
	</tr>
	<tr>
		<td><label for="enddate">Ending Date:</label></td>
		<td><input type="text" id="enddate" name="enddate" onClick="removeContents('enddate', 'yyyy-mm-dd')" value="yyyy-mm-dd" class="validate"/></td>
	</tr>
</table>


<br />

<input type="submit" value="Create Summary">

</form>