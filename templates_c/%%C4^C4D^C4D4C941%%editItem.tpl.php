<?php /* Smarty version 2.6.22, created on 2009-03-14 17:08:47
         compiled from editItem.tpl */ ?>

<form name="editItem" action="updateItem.php" onsubmit="return ValidateEditForm(this)" METHOD="post">

<h3>Edit Item</h3>

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

<table width="400">

<input type="hidden" name="inventory_id<?php echo $this->_sections['num']['index']; ?>
" size="40" value="<?php echo $this->_tpl_vars['items'][$this->_sections['num']['index']]->inventory_id; ?>
">

<tr>
	<td>Description:
</td>
	<td><input type="text" name="desc<?php echo $this->_sections['num']['index']; ?>
" size="40" id="description" value="<?php echo $this->_tpl_vars['items'][$this->_sections['num']['index']]->description; ?>
"></td>
</tr>

<tr>
	<td>Value: </td>
	<td><input type="text" name="value<?php echo $this->_sections['num']['index']; ?>
" size="40" id="value" value="<?php echo $this->_tpl_vars['items'][$this->_sections['num']['index']]->current_value; ?>
"></td>
</tr>

<tr>
	<td>Condition: </td>
	<td>
		<select name="condition<?php echo $this->_sections['num']['index']; ?>
">
			<option value="Excellent" <?php if ($this->_tpl_vars['items'][$this->_sections['num']['index']]->current_condition == 'Excellent'): ?>selected<?php endif; ?>>Excellent</option>
			<option value="Good" <?php if ($this->_tpl_vars['items'][$this->_sections['num']['index']]->current_condition == 'Good'): ?>selected<?php endif; ?>>Good</option>
			<option value="Fair" <?php if ($this->_tpl_vars['items'][$this->_sections['num']['index']]->current_condition == 'Fair'): ?>selected<?php endif; ?>>Fair</option>
			<option value="Poor" <?php if ($this->_tpl_vars['items'][$this->_sections['num']['index']]->current_condition == 'Poor'): ?>selected<?php endif; ?>>Poor</option>
		</select>
	</td>
</tr>

<tr>
	<td>Location: </td>
	<td>
	
	<select name="location<?php echo $this->_sections['num']['index']; ?>
" id="location<?php echo $this->_sections['num']['index']; ?>
" onChange="OnChangeDouble('location<?php echo $this->_sections['num']['index']; ?>
', 'newLocation<?php echo $this->_sections['num']['index']; ?>
', 'newDescription<?php echo $this->_sections['num']['index']; ?>
')">   
    <?php unset($this->_sections['loc']);
$this->_sections['loc']['name'] = 'loc';
$this->_sections['loc']['loop'] = is_array($_loop=$this->_tpl_vars['locations']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loc']['show'] = true;
$this->_sections['loc']['max'] = $this->_sections['loc']['loop'];
$this->_sections['loc']['step'] = 1;
$this->_sections['loc']['start'] = $this->_sections['loc']['step'] > 0 ? 0 : $this->_sections['loc']['loop']-1;
if ($this->_sections['loc']['show']) {
    $this->_sections['loc']['total'] = $this->_sections['loc']['loop'];
    if ($this->_sections['loc']['total'] == 0)
        $this->_sections['loc']['show'] = false;
} else
    $this->_sections['loc']['total'] = 0;
if ($this->_sections['loc']['show']):

            for ($this->_sections['loc']['index'] = $this->_sections['loc']['start'], $this->_sections['loc']['iteration'] = 1;
                 $this->_sections['loc']['iteration'] <= $this->_sections['loc']['total'];
                 $this->_sections['loc']['index'] += $this->_sections['loc']['step'], $this->_sections['loc']['iteration']++):
$this->_sections['loc']['rownum'] = $this->_sections['loc']['iteration'];
$this->_sections['loc']['index_prev'] = $this->_sections['loc']['index'] - $this->_sections['loc']['step'];
$this->_sections['loc']['index_next'] = $this->_sections['loc']['index'] + $this->_sections['loc']['step'];
$this->_sections['loc']['first']      = ($this->_sections['loc']['iteration'] == 1);
$this->_sections['loc']['last']       = ($this->_sections['loc']['iteration'] == $this->_sections['loc']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['locations'][$this->_sections['loc']['index']]->location_id; ?>
">
			<?php echo $this->_tpl_vars['locations'][$this->_sections['loc']['index']]->location; ?>

		</option>
        <?php endfor; else: ?>
  		<option value = "-2">
        </option>
	<?php endif; ?>
        <option value = "-1">
			New Location
		</option>
        
	</select>
	
	</td>
</tr>
    <tr id="newLocation<?php echo $this->_sections['num']['index']; ?>
" style="display:none">
            <td>New Location:</td>
        <td>
                <input type="text" name="newlocation<?php echo $this->_sections['num']['index']; ?>
" size="40">
        </td>
    </tr>
    <tr id="newDescription<?php echo $this->_sections['num']['index']; ?>
" style="display:none">
            <td>Location Description:</td>
        <td>
                <input type="text" name="newdescription<?php echo $this->_sections['num']['index']; ?>
" size="40">
        </td>
    </tr>
	

</table>

<br>
<br>

<?php endfor; endif; ?>

<br>
<input type="submit" value="Edit">

</form>