<?php /* Smarty version 2.6.22, created on 2009-04-08 13:10:36
         compiled from repairItems.tpl */ ?>

<form name="editItem" action="insertRepairRecord.php" onsubmit="return ValidateForm()" METHOD="post">

<h3>Repair Items</h3>

<input type="hidden" name="count" size="40" value="<?php echo $this->_tpl_vars['itemCount']; ?>
">

<?php unset($this->_sections['num']);
$this->_sections['num']['name'] = 'num';
$this->_sections['num']['loop'] = is_array($_loop=$this->_tpl_vars['items']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['num']['show'] = true;
$this->_sections['num']['max'] = $this->_sections['num']['loop'];
$this->_sections['num']['step'] = 1;
$this->_sections['num']['start'] = $this->_sections['num']['step'] > 0 ? 0 : $this->_sections['num']['loop']-1;
if ($this->_sections['num']['show']) {
    $this->_sections['num']['total'] = $this->_sections['num']['loop'];
    if ($this->_sections['num']['total'] == 0)
        $this->_sections['num']['show'] = false;
} else
    $this->_sections['num']['total'] = 0;
if ($this->_sections['num']['show']):

            for ($this->_sections['num']['index'] = $this->_sections['num']['start'], $this->_sections['num']['iteration'] = 1;
                 $this->_sections['num']['iteration'] <= $this->_sections['num']['total'];
                 $this->_sections['num']['index'] += $this->_sections['num']['step'], $this->_sections['num']['iteration']++):
$this->_sections['num']['rownum'] = $this->_sections['num']['iteration'];
$this->_sections['num']['index_prev'] = $this->_sections['num']['index'] - $this->_sections['num']['step'];
$this->_sections['num']['index_next'] = $this->_sections['num']['index'] + $this->_sections['num']['step'];
$this->_sections['num']['first']      = ($this->_sections['num']['iteration'] == 1);
$this->_sections['num']['last']       = ($this->_sections['num']['iteration'] == $this->_sections['num']['total']);
?>

<table width="500">

<input type="hidden" name="inventory_id<?php echo $this->_sections['num']['index']; ?>
" size="40" value="<?php echo $this->_tpl_vars['items'][$this->_sections['num']['index']]->inventory_id; ?>
">

<tr>
	<td>Item:</td>
	<td><?php echo $this->_tpl_vars['items'][$this->_sections['num']['index']]->description; ?>
</td>
</tr>

<tr>
	<td>Repair Description:</td>
	<td><input type="text" name="desc<?php echo $this->_sections['num']['index']; ?>
" size="40" id="description" class="validate"></td>
</tr>

<tr>
	<td>Cost: </td>
	<td><input type="text" name="cost<?php echo $this->_sections['num']['index']; ?>
" size="10" id="cost" class="validate"></td>
</tr>

<tr>
	<td>Date: </td>
	<td>
	
				<select name="months<?php echo $this->_sections['num']['index']; ?>
">
                    <option value="1"<?php if ($this->_tpl_vars['selectDate']['mon'] == 1): ?> selected<?php endif; ?>>January</option>
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

                <select name="days<?php echo $this->_sections['num']['index']; ?>
">
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
				
				
                <select name="year<?php echo $this->_sections['num']['index']; ?>
">
                    <option value="2007"<?php if ($this->_tpl_vars['selectDate']['year'] == 2007): ?>selected<?php endif; ?>>2007</option>
                    <option value="2008"<?php if ($this->_tpl_vars['selectDate']['year'] == 2008): ?>selected<?php endif; ?>>2008</option>
					<option value="2009"<?php if ($this->_tpl_vars['selectDate']['year'] == 2009): ?>selected<?php endif; ?>>2009</option>
                </select>
	
	<td>
</tr>

<tr>
	<td>Business: </td>
	<td>
	
	<select id="business_id" name="businessId<?php echo $this->_sections['num']['index']; ?>
" onChange="OnChange('business_id', 'newBusiness')">
	<?php unset($this->_sections['biz']);
$this->_sections['biz']['name'] = 'biz';
$this->_sections['biz']['loop'] = is_array($_loop=$this->_tpl_vars['businesses']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['biz']['show'] = true;
$this->_sections['biz']['max'] = $this->_sections['biz']['loop'];
$this->_sections['biz']['step'] = 1;
$this->_sections['biz']['start'] = $this->_sections['biz']['step'] > 0 ? 0 : $this->_sections['biz']['loop']-1;
if ($this->_sections['biz']['show']) {
    $this->_sections['biz']['total'] = $this->_sections['biz']['loop'];
    if ($this->_sections['biz']['total'] == 0)
        $this->_sections['biz']['show'] = false;
} else
    $this->_sections['biz']['total'] = 0;
if ($this->_sections['biz']['show']):

            for ($this->_sections['biz']['index'] = $this->_sections['biz']['start'], $this->_sections['biz']['iteration'] = 1;
                 $this->_sections['biz']['iteration'] <= $this->_sections['biz']['total'];
                 $this->_sections['biz']['index'] += $this->_sections['biz']['step'], $this->_sections['biz']['iteration']++):
$this->_sections['biz']['rownum'] = $this->_sections['biz']['iteration'];
$this->_sections['biz']['index_prev'] = $this->_sections['biz']['index'] - $this->_sections['biz']['step'];
$this->_sections['biz']['index_next'] = $this->_sections['biz']['index'] + $this->_sections['biz']['step'];
$this->_sections['biz']['first']      = ($this->_sections['biz']['iteration'] == 1);
$this->_sections['biz']['last']       = ($this->_sections['biz']['iteration'] == $this->_sections['biz']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['businesses'][$this->_sections['biz']['index']]->business_id; ?>
">
			<?php echo $this->_tpl_vars['businesses'][$this->_sections['biz']['index']]->company_name; ?>

		</option>
	<?php endfor; endif; ?>
    	<option value="-1">
			Add a New Business
		</option>
	</select>
	
	</td>
</tr>
	<tr>
		<table id="newBusiness" style="display:none;padding-left:1cm">	

     	 	<tr>
			<td>Company Name:</td>
			<td><input type="text" name="company" size="30"></td>
     	 	</tr>

     	 	<tr>
			<td>Address:</td>
			<td> <input type="text" name="address" size="30"></td>
     	 	</tr>

     	 	<tr>
			<td>Address 2:</td>
			<td><input type="text" name="address2" size="30"></td>
     	 	</tr>

     	 	<tr>
			<td>City: </td>
			<td><input type="text" name="city" size="30"></td>
     	 	</tr>

     	 	<tr>
			<td>State: </td>
			<td><input type="text" name="state" size="10"></td>
     	 	</tr>

     	 	<tr>
			<td>Zip Code: </td>
			<td><input type="text" name="zip" size="10"></td>
     	 	</tr>

     	 	<tr>
			<td>Phone Number: </td>
			<td><input type="text" name="phone" size="20"></td>
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
	</tr>


</table>

<br>
<br>

<?php endfor; endif; ?>

<br>
<input type="submit" value="Repair">

<form>