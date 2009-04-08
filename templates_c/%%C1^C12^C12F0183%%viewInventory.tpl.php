<?php /* Smarty version 2.6.22, created on 2009-04-15 14:48:17
         compiled from viewInventory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'viewInventory.tpl', 138, false),)), $this); ?>

<form id="itemList" name="itemList">

<table width="800" border="0" class="itemsTable" cellspacing="0" >
	<tr>
		<?php if ($this->_tpl_vars['authority'] >= 1): ?>
			<th width="20"> </th>
		<?php endif; ?>

        
        <th width="250">
    
        <?php if (! isset ( $this->_tpl_vars['sort'] )): ?>
		  <a class="tableHeaderLink" href="viewInventory.php?sort=description&sortdir=DESC">
		    Item
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
		  </a>
    
    		<?php elseif ($this->_tpl_vars['sort'] == 'description' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewInventory.php?sort=description&sortdir=DESC">
        Item
        <img class="tableHeaderSortTriangle" src="images/sortTriangleUp.png" />
      </a>

				<?php elseif ($this->_tpl_vars['sort'] == 'description' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="viewInventory.php?sort=description">
		    Item
		    <img class="tableHeaderSortTriangle" src="images/sortTriangleDown.png" />
      </a>
        <?php else: ?>
      <a class="tableHeaderLink" href="viewInventory.php?sort=description">
		    Item
      </a>
		  <?php endif; ?>
		</th>
		  
				<th width="100">
		
				<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'current_condition' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		<a class="tableHeaderLink" href="viewInventory.php?sort=current_condition&sortdir=DESC">
		  Condition
		  <img src="images/sortTriangleUp.png" />
		</a>
		
				<?php elseif ($this->_tpl_vars['sort'] == 'current_condition' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		<a class="tableHeaderLink" href="viewInventory.php?sort=current_condition">
		  Condition
		  <img src="images/sortTriangleDown.png" />
		</a>
		
				<?php else: ?>
		<a class="tableHeaderLink" href="viewInventory.php?sort=current_condition">
		  Condition
		</a>
		<?php endif; ?>
		</th>
		
				<th>
				<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'current_value' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewInventory.php?sort=current_value&sortdir=DESC">
		    Value
		    <img src="images/sortTriangleUp.png" />
		  </a>
				<?php elseif ($this->_tpl_vars['sort'] == 'current_value' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
	    <a class="tableHeaderLink" href="viewInventory.php?sort=current_value">
	      Value
	      <img src="images/sortTriangleDown.png" />
	    </a>
				<?php else: ?>
		  <a class="tableHeaderLink" href="viewInventory.php?sort=current_value">
		    Value
		  </a>
		<?php endif; ?>
		</th>
		
				<th>
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'location' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewInventory.php?sort=location&sortdir=DESC">
		    Location
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif ($this->_tpl_vars['sort'] == 'location' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="viewInventory.php?sort=location">
		    Location
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="viewInventory.php?sort=location">
		    Location
		  </a>
		<?php endif; ?>
		</th>

		</tr>

<?php unset($this->_sections['itemLoop']);
$this->_sections['itemLoop']['name'] = 'itemLoop';
$this->_sections['itemLoop']['loop'] = is_array($_loop=$this->_tpl_vars['items']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['itemLoop']['show'] = true;
$this->_sections['itemLoop']['max'] = $this->_sections['itemLoop']['loop'];
$this->_sections['itemLoop']['step'] = 1;
$this->_sections['itemLoop']['start'] = $this->_sections['itemLoop']['step'] > 0 ? 0 : $this->_sections['itemLoop']['loop']-1;
if ($this->_sections['itemLoop']['show']) {
    $this->_sections['itemLoop']['total'] = $this->_sections['itemLoop']['loop'];
    if ($this->_sections['itemLoop']['total'] == 0)
        $this->_sections['itemLoop']['show'] = false;
} else
    $this->_sections['itemLoop']['total'] = 0;
if ($this->_sections['itemLoop']['show']):

            for ($this->_sections['itemLoop']['index'] = $this->_sections['itemLoop']['start'], $this->_sections['itemLoop']['iteration'] = 1;
                 $this->_sections['itemLoop']['iteration'] <= $this->_sections['itemLoop']['total'];
                 $this->_sections['itemLoop']['index'] += $this->_sections['itemLoop']['step'], $this->_sections['itemLoop']['iteration']++):
$this->_sections['itemLoop']['rownum'] = $this->_sections['itemLoop']['iteration'];
$this->_sections['itemLoop']['index_prev'] = $this->_sections['itemLoop']['index'] - $this->_sections['itemLoop']['step'];
$this->_sections['itemLoop']['index_next'] = $this->_sections['itemLoop']['index'] + $this->_sections['itemLoop']['step'];
$this->_sections['itemLoop']['first']      = ($this->_sections['itemLoop']['iteration'] == 1);
$this->_sections['itemLoop']['last']       = ($this->_sections['itemLoop']['iteration'] == $this->_sections['itemLoop']['total']);
?>
<tr<?php echo smarty_function_cycle(array('values' => " class=\"alt\","), $this);?>
>
	<?php if ($this->_tpl_vars['authority'] >= 1): ?>
		<td><input type="checkbox" name="<?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->inventory_id; ?>
" id="<?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->inventory_id; ?>
"></td>
	<?php endif; ?>
	<td><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->description; ?>
</td>
	<td><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->current_condition; ?>
</td>
	<td><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->current_value; ?>
</td>
	<td align="center"><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->location; ?>
</td>
</tr>
<?php endfor; endif; ?>	


</table>
<br>

<?php if ($this->_tpl_vars['authority'] >= 1): ?>
	
<select name="action_list" id="action_list">

<option value="Loan">Loan</option>
<option value="Edit">Edit</option>
<option value="Repair">Repair</option>
<option value="Delete">Delete</option>
</select>


<input type="button" onclick="submitItems()" value="Go">
<?php endif; ?>

</form>

<?php if ($this->_tpl_vars['authority'] >= 1): ?>

<br />
<a href="makeInventorySummary.php"><img border="0" src="images/pdficon_small.gif" />&nbsp;&nbsp;Download PDF</a>

<?php endif; ?>