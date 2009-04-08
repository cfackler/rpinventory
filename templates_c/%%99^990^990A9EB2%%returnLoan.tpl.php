<?php /* Smarty version 2.6.22, created on 2009-04-08 11:17:40
         compiled from returnLoan.tpl */ ?>

<form name="loanItem" action="updateLoanRecord.php" METHOD="post">

<h3>Return Loan Item</h3>



<table width="400">

<input type="hidden" name="loan_id" size="40" value="<?php echo $this->_tpl_vars['loan_id']; ?>
">
<input type="hidden" name="inv_id" size="40" value="<?php echo $this->_tpl_vars['item']->inventory_id; ?>
">

<tr>
	<td>Description: </td>
	<td><?php echo $this->_tpl_vars['item']->description; ?>
</td>
</tr>


<tr>
	<td>Return Date: </td>
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
	<td>Previous Condition: </td>
	<td><?php echo $this->_tpl_vars['item']->current_condition; ?>
</td>
</tr>

<tr>
	<td>Returned Condition: </td>
	<td>
		<select name="condition">
			<option value="Excellent"<?php if ($this->_tpl_vars['item']->current_condition == 'Excellent'): ?>selected<?php endif; ?>>Excellent</option>
			<option value="Good"<?php if ($this->_tpl_vars['item']->current_condition == 'Good'): ?>selected<?php endif; ?>>Good</option>
			<option value="Fair"<?php if ($this->_tpl_vars['item']->current_condition == 'Fair'): ?>selected<?php endif; ?>>Fair</option>
			<option value="Poor"<?php if ($this->_tpl_vars['item']->current_condition == 'Poor'): ?>selected<?php endif; ?>>Poor</option>
		</select>
	</td>
</tr>


</table>

<br />

<input type="submit" value="Return">


<form>