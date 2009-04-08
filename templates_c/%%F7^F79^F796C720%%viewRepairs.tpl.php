<?php /* Smarty version 2.6.22, created on 2009-04-15 12:33:48
         compiled from viewRepairs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'viewRepairs.tpl', 132, false),)), $this); ?>

<div class="TopOfTable"><span class="TopOfTable">
<h3>Repairs</h3>
</span>
</div>
<?php if ($this->_tpl_vars['authority'] > 1): ?>
    <table width="800" border="0" class="itemsTable" cellspacing="0">
    	<tr>
    		
		<th width="200">
				<?php if (! isset ( $this->_tpl_vars['sort'] )): ?>
		  <a href="viewRepairs.php?sort=inv_description&sortdir=DESC">
		    Item
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'inv_description' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a href="viewRepairs.php?sort=inv_description&sortdir=DESC">
		    Item
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'inv_description' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a href="viewRepairs.php?sort=inv_description">
		    Item
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a href="viewRepairs.php?sort=inv_description">
		    Item
		  </a>
		<?php endif; ?>
		</th>
		
				<th>
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'company_name' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a href="viewRepairs.php?sort=company_name&sortdir=DESC">
		    Company Name
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'company_name' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a href="viewRepairs.php?sort=company_name">
		    Company Name
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a href="viewRepairs.php?sort=company_name">
		    Company Name
		  </a>
		<?php endif; ?>
		</th>
		
				<th>
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'repair_date' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a href="viewRepairs.php?sort=repair_date&sortdir=DESC">
		    Date
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'repair_date' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a href="viewRepairs.php?sort=repair_date">
		    Date
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a href="viewRepairs.php?sort=repair_date">
		    Date
		  </a>
		<?php endif; ?>
		</th>
		
				<th>
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'repair_cost' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a href="viewRepairs.php?sort=repair_cost&sortdir=DESC">
		    Cost
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'repair_cost' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a href="viewRepairs.php?sort=repair_cost">
		    Cost
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a href="viewRepairs.php?sort=repair_cost">
		    Cost
		  </a>
		<?php endif; ?>
		</th>
		
				<th width="250">
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'rep_description' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a href="viewRepairs.php?sort=rep_description&sortdir=DESC">
		    Description
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'rep_description' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a href="viewRepairs.php?sort=rep_description">
		    Description
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a href="viewRepairs.php?sort=rep_description">
		    Description
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

	<td><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->inv_description; ?>
</td>
	<td><a href="viewAddress.php?id=<?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->business_id; ?>
"><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->company_name; ?>
</td>
	<td><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->repair_date; ?>
</td>
	<td>$<?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->repair_cost; ?>
</td>
	<td><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->rep_description; ?>
</td>
    </tr>
    <?php endfor; endif; ?>	


    </table>
<?php else: ?>
    <h3>Repairs</h3>

    <p>Please login if you wish to view information about repairs.</p>
<?php endif; ?>