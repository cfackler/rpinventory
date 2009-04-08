<?php /* Smarty version 2.6.22, created on 2009-04-08 12:25:51
         compiled from loanItem.tpl */ ?>

<form id="AjaxForm" name="loanItem" action="insertLoanRecord.php" onsubmit="return ValidateForm()" METHOD="post">

<h3>Loan Items</h3>

<?php if ($this->_tpl_vars['loanedOut'] == true): ?>
<h4>The following item(s) have already been loaned out:</h4>

<ul>
<?php unset($this->_sections['out']);
$this->_sections['out']['name'] = 'out';
$this->_sections['out']['loop'] = is_array($_loop=$this->_tpl_vars['itemsOut']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['out']['show'] = true;
$this->_sections['out']['max'] = $this->_sections['out']['loop'];
$this->_sections['out']['step'] = 1;
$this->_sections['out']['start'] = $this->_sections['out']['step'] > 0 ? 0 : $this->_sections['out']['loop']-1;
if ($this->_sections['out']['show']) {
    $this->_sections['out']['total'] = $this->_sections['out']['loop'];
    if ($this->_sections['out']['total'] == 0)
        $this->_sections['out']['show'] = false;
} else
    $this->_sections['out']['total'] = 0;
if ($this->_sections['out']['show']):

            for ($this->_sections['out']['index'] = $this->_sections['out']['start'], $this->_sections['out']['iteration'] = 1;
                 $this->_sections['out']['iteration'] <= $this->_sections['out']['total'];
                 $this->_sections['out']['index'] += $this->_sections['out']['step'], $this->_sections['out']['iteration']++):
$this->_sections['out']['rownum'] = $this->_sections['out']['iteration'];
$this->_sections['out']['index_prev'] = $this->_sections['out']['index'] - $this->_sections['out']['step'];
$this->_sections['out']['index_next'] = $this->_sections['out']['index'] + $this->_sections['out']['step'];
$this->_sections['out']['first']      = ($this->_sections['out']['iteration'] == 1);
$this->_sections['out']['last']       = ($this->_sections['out']['iteration'] == $this->_sections['out']['total']);
?>
<li><?php echo $this->_tpl_vars['itemsOut'][$this->_sections['out']['index']]; ?>
</li>
<?php endfor; endif; ?>
</ul>




<?php else: ?>
<table width="400">

<input type="hidden" name="inventory_ids" size="40" value="<?php echo $this->_tpl_vars['idString']; ?>
">

<tr>
	<td valign="top">Items: </td>
	<td>
	
	
		<ul>
			<?php unset($this->_sections['items']);
$this->_sections['items']['name'] = 'items';
$this->_sections['items']['loop'] = is_array($_loop=$this->_tpl_vars['itemDesc']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['items']['show'] = true;
$this->_sections['items']['max'] = $this->_sections['items']['loop'];
$this->_sections['items']['step'] = 1;
$this->_sections['items']['start'] = $this->_sections['items']['step'] > 0 ? 0 : $this->_sections['items']['loop']-1;
if ($this->_sections['items']['show']) {
    $this->_sections['items']['total'] = $this->_sections['items']['loop'];
    if ($this->_sections['items']['total'] == 0)
        $this->_sections['items']['show'] = false;
} else
    $this->_sections['items']['total'] = 0;
if ($this->_sections['items']['show']):

            for ($this->_sections['items']['index'] = $this->_sections['items']['start'], $this->_sections['items']['iteration'] = 1;
                 $this->_sections['items']['iteration'] <= $this->_sections['items']['total'];
                 $this->_sections['items']['index'] += $this->_sections['items']['step'], $this->_sections['items']['iteration']++):
$this->_sections['items']['rownum'] = $this->_sections['items']['iteration'];
$this->_sections['items']['index_prev'] = $this->_sections['items']['index'] - $this->_sections['items']['step'];
$this->_sections['items']['index_next'] = $this->_sections['items']['index'] + $this->_sections['items']['step'];
$this->_sections['items']['first']      = ($this->_sections['items']['iteration'] == 1);
$this->_sections['items']['last']       = ($this->_sections['items']['iteration'] == $this->_sections['items']['total']);
?>
			<li><?php echo $this->_tpl_vars['itemDesc'][$this->_sections['items']['index']]; ?>
</li>
			<?php endfor; endif; ?>
		</ul>
	
	</td>
</tr>


<tr>
	<td>Date: </td>
	<td>
	
				<select name="months">
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
	
	<td>
</tr>

<tr>
	<td>Loan To: </td>
	<td>
	
	<select id="user_id" name="user_id" class="validate" onchange="sendAddressRequest(<?php echo $this->_tpl_vars['users'][$this->_sections['usr']['index']]->id; ?>
);">
		<option value="-1">Select User</option>
	<?php unset($this->_sections['usr']);
$this->_sections['usr']['name'] = 'usr';
$this->_sections['usr']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['usr']['show'] = true;
$this->_sections['usr']['max'] = $this->_sections['usr']['loop'];
$this->_sections['usr']['step'] = 1;
$this->_sections['usr']['start'] = $this->_sections['usr']['step'] > 0 ? 0 : $this->_sections['usr']['loop']-1;
if ($this->_sections['usr']['show']) {
    $this->_sections['usr']['total'] = $this->_sections['usr']['loop'];
    if ($this->_sections['usr']['total'] == 0)
        $this->_sections['usr']['show'] = false;
} else
    $this->_sections['usr']['total'] = 0;
if ($this->_sections['usr']['show']):

            for ($this->_sections['usr']['index'] = $this->_sections['usr']['start'], $this->_sections['usr']['iteration'] = 1;
                 $this->_sections['usr']['iteration'] <= $this->_sections['usr']['total'];
                 $this->_sections['usr']['index'] += $this->_sections['usr']['step'], $this->_sections['usr']['iteration']++):
$this->_sections['usr']['rownum'] = $this->_sections['usr']['iteration'];
$this->_sections['usr']['index_prev'] = $this->_sections['usr']['index'] - $this->_sections['usr']['step'];
$this->_sections['usr']['index_next'] = $this->_sections['usr']['index'] + $this->_sections['usr']['step'];
$this->_sections['usr']['first']      = ($this->_sections['usr']['iteration'] == 1);
$this->_sections['usr']['last']       = ($this->_sections['usr']['iteration'] == $this->_sections['usr']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['users'][$this->_sections['usr']['index']]->id; ?>
">
			<?php echo $this->_tpl_vars['users'][$this->_sections['usr']['index']]->username; ?>

		</option>
	<?php endfor; endif; ?>
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
<?php endif; ?>


</form>