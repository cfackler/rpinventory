<?php /* Smarty version 2.6.22, created on 2009-04-15 12:51:59
         compiled from viewPurchases.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'viewPurchases.tpl', 115, false),)), $this); ?>

<?php if ($this->_tpl_vars['authority'] > 1): ?>
	<div class="TopOfTable"><span class="TopOfTable">
    <h3>Purchases</h3>
    <a href="addPurchase.php">Add a purchase</a>
    </span>
    </div>
    <table width="800" border="0" class="itemsTable" cellspacing="0">
    	<tr>
    
    		<th width="150">
				<?php if (! isset ( $this->_tpl_vars['sort'] )): ?>
		  <a href="viewPurchases.php?sort=purchase_id&sortdir=DESC">
		    Items
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'purchase_id' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a href="viewPurchases.php?sort=purchase_id&sortdir=DESC">
		    Items
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'purchase_id' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a href="viewPurchases.php?sort=purchase_id">
		    Items
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?> 
		  <a href="viewPurchases.php?sort=purchase_id">
		    Items
		  </a>
		<?php endif; ?>
		</th>
		
				<th>
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'company_name' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a href="viewPurchases.php?sort=company_name&sortdir=DESC">
		    Company Name
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'company_name' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a href="viewPurchases.php?sort=company_name">
		    Company Name
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a href="viewPurchases.php?sort=company_name">
		    Company Name
		  </a>
		<?php endif; ?>
		</th>
		
				<th>
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'purchase_date' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a href="viewPurchases.php?sort=purchase_date&sortdir=DESC">
		    Date
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'purchase_date' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a href="viewPurchases.php?sort=purchase_date">
		    Date
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a href="viewPurchases.php?sort=purchase_date">
		    Date
		  </a>
		<?php endif; ?>
		</th>
		
				<th>
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'total_price' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a href="viewPurchases.php?sort=total_price&sortdir=DESC">
		    Total Cost
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'total_price' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a href="viewPurchases.php?sort=total_price">
		    Total Cost
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a href="viewPurchases.php?sort=total_price">
		    Total Cost
		  </a>
		<?php endif; ?>
		</th>
		
	</tr>

    <?php unset($this->_sections['itemLoop']);
$this->_sections['itemLoop']['name'] = 'itemLoop';
$this->_sections['itemLoop']['loop'] = is_array($_loop=$this->_tpl_vars['purchases']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

	<td><?php echo $this->_tpl_vars['purchaseItems'][$this->_sections['itemLoop']['index']]; ?>
</td>
	<td><?php echo $this->_tpl_vars['purchases'][$this->_sections['itemLoop']['index']]->company_name; ?>
</td>
	<td><?php echo $this->_tpl_vars['purchases'][$this->_sections['itemLoop']['index']]->purchase_date; ?>
</td>
	<td>$<?php echo $this->_tpl_vars['purchases'][$this->_sections['itemLoop']['index']]->total_price; ?>
</td>
    </tr>
    <?php endfor; endif; ?>	


    </table>
<?php else: ?>
    <h3>Purchases</h3>

    <p>Please login if you wish to view information about purchases.</p>
<?php endif; ?>