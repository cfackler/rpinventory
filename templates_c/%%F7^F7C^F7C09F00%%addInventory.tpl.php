<?php /* Smarty version 2.6.22, created on 2009-01-28 13:28:43
         compiled from addInventory.tpl */ ?>


<form name="addInventory" action="insertInventory.php" METHOD="post">


<h3>Add Item</h3>

<table width="400">


<tr>
	<td>Description: </td>
	<td><input type="text" name="desc" size="40"></td>
</tr>

<tr>
	<td>Value: </td>
	<td><input type="text" name="value" size="40"></td>
</tr>

<tr>
	<td>Condition: </td>
	<td>
		<select name="condition">
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
	
	<select id = "location_id" name="location_id" onChange="OnChange('location_id', 'newLocation')">
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
        <?php endfor; endif; ?>
    
        <option value = "-1">
            New Location
        </option>
	</select>
    <tr>
    <table id="newLocation" style="display:none;padding-left:1cm">
        <tr>
            <td>Location: </td>
            <td><input type="text" name="newLocationName" size="40"></td>
        </tr>
        
        <tr>
            <td>Description: </td>
            <td><textarea name="newLocationDescription" rows="6" cols="30"></textarea></td>
        </tr>
            </td>
        </tr>
    </table>
    </tr>

</table>

<br>
<input type="submit" value="Add Item">

</form>