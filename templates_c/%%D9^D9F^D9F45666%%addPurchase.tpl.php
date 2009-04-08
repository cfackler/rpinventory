<?php /* Smarty version 2.6.22, created on 2009-04-04 12:03:44
         compiled from addPurchase.tpl */ ?>

<h3>Create Purchase</h3>

<form id="AjaxForm" name="purchaseItem" action="insertPurchaseRecord.php" onsubmit="return ValidateForm()" METHOD="post">

  <input type="hidden" name="count" id="count" value="1">

  <ul style="list-style-type:none">
    <input type="checkbox" name="ignoreBusiness" id="ignoreBusiness" onclick="hideBusiness()"/>
    <label for="ignoreBusiness">Ignore Business Information</label>
    
    <br />

    <span id="businessInformation">
    <br />
    <li>
        <table><tr>
	<td>Purchased	From:</td>
      
	<td><select id="business_id" name="business_id" onChange="OnChange('business_id', 'newBusiness')" class="validate_cond">
	<option value="-1">Select Business</option>
	<?php unset($this->_sections['bus']);
$this->_sections['bus']['name'] = 'bus';
$this->_sections['bus']['loop'] = is_array($_loop=$this->_tpl_vars['businesses']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['bus']['show'] = true;
$this->_sections['bus']['max'] = $this->_sections['bus']['loop'];
$this->_sections['bus']['step'] = 1;
$this->_sections['bus']['start'] = $this->_sections['bus']['step'] > 0 ? 0 : $this->_sections['bus']['loop']-1;
if ($this->_sections['bus']['show']) {
    $this->_sections['bus']['total'] = $this->_sections['bus']['loop'];
    if ($this->_sections['bus']['total'] == 0)
        $this->_sections['bus']['show'] = false;
} else
    $this->_sections['bus']['total'] = 0;
if ($this->_sections['bus']['show']):

            for ($this->_sections['bus']['index'] = $this->_sections['bus']['start'], $this->_sections['bus']['iteration'] = 1;
                 $this->_sections['bus']['iteration'] <= $this->_sections['bus']['total'];
                 $this->_sections['bus']['index'] += $this->_sections['bus']['step'], $this->_sections['bus']['iteration']++):
$this->_sections['bus']['rownum'] = $this->_sections['bus']['iteration'];
$this->_sections['bus']['index_prev'] = $this->_sections['bus']['index'] - $this->_sections['bus']['step'];
$this->_sections['bus']['index_next'] = $this->_sections['bus']['index'] + $this->_sections['bus']['step'];
$this->_sections['bus']['first']      = ($this->_sections['bus']['iteration'] == 1);
$this->_sections['bus']['last']       = ($this->_sections['bus']['iteration'] == $this->_sections['bus']['total']);
?>
	<option value="<?php echo $this->_tpl_vars['businesses'][$this->_sections['bus']['index']]->business_id; ?>
">
	  <?php echo $this->_tpl_vars['businesses'][$this->_sections['bus']['index']]->company_name; ?>

	</option>
	<?php endfor; endif; ?>

	<option value="newBusiness">
	  Add a New Business
	</option>
      </select>
      </td>
     </tr>
     <tr id="newBusiness" style="display:none;">
      <td colspan="2">
      <table style="padding-left: 1cm">	
     	<tr>
	  <td>Company Name:</td>
	  <td><input type="text" name="company" size="30" id="company" class="validate_cond_bus" onchange="sendValidateRequest('company')"></td>
     	</tr>

     	<tr>
	  <td>Address:</td>
	  <td> <input type="text" name="address" size="30" id="address" class="validate_cond_bus"></td>
     	</tr>

     	<tr>
	  <td>Address 2:</td>
	  <td><input type="text" name="address2" size="30"></td>
     	</tr>

     	<tr>
	  <td>City: </td>
	  <td><input type="text" name="city" size="30" id="city" class="validate_cond_bus"></td>
     	</tr>

     	<tr>
	  <td>State: </td>
	  <td><input type="text" name="state" size="10" id="state" class="validate_cond_bus"></td>
     	</tr>

     	<tr>
	  <td>Zip Code: </td>
	  <td><input type="text" name="zip" size="10" id="zip" class="validate_cond_bus"></td>
     	</tr>

     	<tr>
	  <td>Phone Number: </td>
	  <td><input type="text" name="phone" size="20" id="phone" class="validate_cond_bus"></td>
     	</tr>

     	<tr>
	  <td>Fax Number: </td>
	  <td><input type="text" name="fax" size="20"></td>
     	</tr>

     	<tr>
	  <td>E-mail: </td>
	  <td><input type="text" name="email" size="30"></td>
     	</tr>

     	<tr>
	  <td>Website: </td>
	  <td><input type="text" name="website" size="30"></td>
     	</tr>
      </table>
     </td>
    </tr>
    <tr>
      <td>
	Date:
      </td>
      <td>
      <select name="months">
        <option value="1"<?php if ($this->_tpl_vars['selectDate']['mon'] == 1): ?>selected<?php endif; ?>>January</option>
        <option value="2"<?php if ($this->_tpl_vars['selectDate']['mon'] == 2): ?>selected<?php endif; ?>>February</option>
        <option value="3"<?php if ($this->_tpl_vars['selectDate']['mon'] == 3): ?>selected<?php endif; ?>>March</option>
        <option value="4"<?php if ($this->_tpl_vars['selectDate']['mon'] == 4): ?>selected<?php endif; ?>>April</option>
        <option value="5"<?php if ($this->_tpl_vars['selectDate']['mon'] == 5): ?>selected<?php endif; ?>>May</option>
        <option value="6"<?php if ($this->_tpl_vars['selectDate']['mon'] == 6): ?>selected<?php endif; ?>>June</option>
        <option value="7"<?php if ($this->_tpl_vars['selectDate']['mon'] == 7): ?>selected<?php endif; ?>>July</option>
        <option value="8"<?php if ($this->_tpl_vars['selectDate']['mon'] == 8): ?>selected<?php endif; ?>>August</option>
        <option value="9"<?php if ($this->_tpl_vars['selectDate']['mon'] == 9): ?>selected<?php endif; ?>>September</option>
        <option value="10"<?php if ($this->_tpl_vars['selectDate']['mon'] == 10): ?>selected<?php endif; ?>>October</option>
        <option value="11"<?php if ($this->_tpl_vars['selectDate']['mon'] == 11): ?>selected<?php endif; ?>>November</option>
        <option value="12"<?php if ($this->_tpl_vars['selectDate']['mon'] == 12): ?>selected<?php endif; ?>>December</option>
      </select>

      <select name="days">
        <option value="1"<?php if ($this->_tpl_vars['selectDate']['mday'] == 1): ?>selected<?php endif; ?>>1</option>
        <option value="2"<?php if ($this->_tpl_vars['selectDate']['mday'] == 2): ?>selected<?php endif; ?>>2</option>
        <option value="3"<?php if ($this->_tpl_vars['selectDate']['mday'] == 3): ?>selected<?php endif; ?>>3</option>
        <option value="4"<?php if ($this->_tpl_vars['selectDate']['mday'] == 4): ?>selected<?php endif; ?>>4</option>
        <option value="5"<?php if ($this->_tpl_vars['selectDate']['mday'] == 5): ?>selected<?php endif; ?>>5</option>
        <option value="6"<?php if ($this->_tpl_vars['selectDate']['mday'] == 6): ?>selected<?php endif; ?>>6</option>
        <option value="7"<?php if ($this->_tpl_vars['selectDate']['mday'] == 7): ?>selected<?php endif; ?>>7</option>
        <option value="8"<?php if ($this->_tpl_vars['selectDate']['mday'] == 8): ?>selected<?php endif; ?>>8</option>
        <option value="9"<?php if ($this->_tpl_vars['selectDate']['mday'] == 9): ?>selected<?php endif; ?>>9</option>
        <option value="10"<?php if ($this->_tpl_vars['selectDate']['mday'] == 10): ?>selected<?php endif; ?>>10</option>
        <option value="11"<?php if ($this->_tpl_vars['selectDate']['mday'] == 11): ?>selected<?php endif; ?>>11</option>
        <option value="12"<?php if ($this->_tpl_vars['selectDate']['mday'] == 12): ?>selected<?php endif; ?>>12</option>
        <option value="13"<?php if ($this->_tpl_vars['selectDate']['mday'] == 13): ?>selected<?php endif; ?>>13</option>
        <option value="14"<?php if ($this->_tpl_vars['selectDate']['mday'] == 14): ?>selected<?php endif; ?>>14</option>
        <option value="15"<?php if ($this->_tpl_vars['selectDate']['mday'] == 15): ?>selected<?php endif; ?>>15</option>
        <option value="16"<?php if ($this->_tpl_vars['selectDate']['mday'] == 16): ?>selected<?php endif; ?>>16</option>
        <option value="17"<?php if ($this->_tpl_vars['selectDate']['mday'] == 17): ?>selected<?php endif; ?>>17</option>
        <option value="18"<?php if ($this->_tpl_vars['selectDate']['mday'] == 18): ?>selected<?php endif; ?>>18</option>
        <option value="19"<?php if ($this->_tpl_vars['selectDate']['mday'] == 19): ?>selected<?php endif; ?>>19</option>
        <option value="20"<?php if ($this->_tpl_vars['selectDate']['mday'] == 20): ?>selected<?php endif; ?>>20</option>
        <option value="21"<?php if ($this->_tpl_vars['selectDate']['mday'] == 21): ?>selected<?php endif; ?>>21</option>
        <option value="22"<?php if ($this->_tpl_vars['selectDate']['mday'] == 22): ?>selected<?php endif; ?>>22</option>
        <option value="23"<?php if ($this->_tpl_vars['selectDate']['mday'] == 23): ?>selected<?php endif; ?>>23</option>
        <option value="24"<?php if ($this->_tpl_vars['selectDate']['mday'] == 24): ?>selected<?php endif; ?>>24</option>
        <option value="25"<?php if ($this->_tpl_vars['selectDate']['mday'] == 25): ?>selected<?php endif; ?>>25</option>
        <option value="26"<?php if ($this->_tpl_vars['selectDate']['mday'] == 26): ?>selected<?php endif; ?>>26</option>
        <option value="27"<?php if ($this->_tpl_vars['selectDate']['mday'] == 27): ?>selected<?php endif; ?>>27</option>
        <option value="28"<?php if ($this->_tpl_vars['selectDate']['mday'] == 28): ?>selected<?php endif; ?>>28</option>
        <option value="29"<?php if ($this->_tpl_vars['selectDate']['mday'] == 29): ?>selected<?php endif; ?>>29</option>
        <option value="30"<?php if ($this->_tpl_vars['selectDate']['mday'] == 30): ?>selected<?php endif; ?>>30</option>
        <option value="31"<?php if ($this->_tpl_vars['selectDate']['mday'] == 31): ?>selected<?php endif; ?>>31</option>
      </select>
      
      
      <select name="year">
        <option value="2007"<?php if ($this->_tpl_vars['selectDate']['year'] == 2007): ?>selected<?php endif; ?>>2007</option>
        <option value="2008"<?php if ($this->_tpl_vars['selectDate']['year'] == 2008): ?>selected<?php endif; ?>>2008</option>
	<option value="2009"<?php if ($this->_tpl_vars['selectDate']['year'] == 2009): ?>selected<?php endif; ?>>2009</option>
      </select>
     </td>
    </tr>

    <tr>
     <td>
      Total Value of Purchase: 
     </td>
     <td>
      <input type="text" name="total_cost" value="" id="total_cost" class="validate">
     </td>
    </tr>
    </table>
    </span>

    <br />

    <div id="itemTable">
      <div id="item0">
	<table>
	  <tr>
	    <td>Item Description: </td>
	    <td><input type="text" name="desc0" size="40" id="description0" class="validate"></td>
	  </tr>
	  
	  <tr>
	    <td>Value: </td>
	    <td><input type="text" name="value0" id="value0" class="validate"></td>
	  </tr>
	  
	  <tr>
	    <td>Condition: </td>
	    <td>
	      <select name="condition0">
		<option value="Excellent">Excellent</option>
		<option value="Good">Good</option>
		<option value="Fair">Fair</option>
		<option value="Poor">Poor</option>
	      </select>
	    </td>
	  </tr>

	  <tr>
	    <td>Location: </td>

	    <td>
	      <select id="location0" name="location0" onChange="OnChangeDouble('location0', 'newLocation0', 'newDescription0')" onFocus="getLocationOptions(this);">

			<?php echo $this->_tpl_vars['locations']; ?>

		
	      </select>
	    <span id="resultText0"></span>
	    </td>
	  </tr>

	  <tr id="newLocation0" style="display:none">
	    <td>New Location:</td>
	    <td>
	      <input type="text" name="newlocation0" id="newlocation0" size="40" onChange="sendValidateRequest('newlocation0')">
	    </td>
	  </tr>
	  <tr id="newDescription0" style="display:none">
	    <td>Location Description:</td>
	    <td>
	      <input type="text" name="newdescription0" id="newdescription0" size="40">
	    </td>
	    <td><input value="Save Location" type="button" onClick="saveLocation('newlocation0', 'newdescription0', 'resultText0', 'location0', 'newLocation0', 'newDescription0');">
	    </td>
	  </tr>
	</table>
      </div>
    <br />
    </div>
    <div>
      <td><input type="button" class="button" onClick="addItemField();" value="Add Item">
	<input type="button" class="button" id="removeButton" style="display:none;" onClick="removeItemField();" value="Remove Last Item"></td>
      <td></td>
    </div>

    
</ul>
<br />
<input type="submit" value="Purchase">
</form>