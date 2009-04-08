<?php /* Smarty version 2.6.22, created on 2009-04-15 15:03:56
         compiled from manageLocations.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'manageLocations.tpl', 78, false),)), $this); ?>

<div class="TopOfTable"><span class="TopOfTable">
<h3>Locations</h3>
<a href="addLocation.php">Add new location</a>
</span></div>

<table width="700" border="0" cellspacing="0" class="itemsTable">
	<tr>
	   
    		<th width="200">
				<?php if (! isset ( $this->_tpl_vars['sort'] )): ?>
		  <a class="tableHeaderLink" href="?sort=location&sortdir=DESC">
		    Location
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'location' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="?sort=location&sortdir=DESC">
		    Location
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'location' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="?sort=location">
		    Location
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="?sort=location">
		    Location
		  </a>
		<?php endif; ?>
		</th>
		
				<th width="300">
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'description' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="?sort=description&sortdir=DESC">
		    Description
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'description' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="?sort=description">
		    Description
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="?sort=description">
		    Description
		  </a>
		<?php endif; ?>
		</th>
		
				<th>Actions</th>
	</tr>

<?php unset($this->_sections['num']);
$this->_sections['num']['name'] = 'num';
$this->_sections['num']['loop'] = is_array($_loop=$this->_tpl_vars['locations']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<tr<?php echo smarty_function_cycle(array('values' => " class=\"alt\","), $this);?>
>

	<td align="center"><?php echo $this->_tpl_vars['locations'][$this->_sections['num']['index']]->location; ?>
</td>
	<td align="center"><?php echo $this->_tpl_vars['locations'][$this->_sections['num']['index']]->description; ?>
</td>
	<td align="center">
	<a href="editLocation.php?id=<?php echo $this->_tpl_vars['locations'][$this->_sections['num']['index']]->location_id; ?>
">Edit</a> or  
	<input type="button" onclick="confirmation('Are you sure you want to delete location \'<?php echo $this->_tpl_vars['locations'][$this->_sections['num']['index']]->location; ?>
\' ?','deleteLocation.php?id=<?php echo $this->_tpl_vars['locations'][$this->_sections['num']['index']]->location_id; ?>
')" value="Delete">
	</td>
</tr>
<?php endfor; endif; ?>	


</table>