<?php /* Smarty version 2.6.22, created on 2009-04-15 12:06:16
         compiled from viewLoans.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'viewLoans.tpl', 152, false),)), $this); ?>
<div class="TopOfTable">
<span class="TopOfTable">
<h3>Loans</h3>
Show:

<?php if ($this->_tpl_vars['filter'] != 'all'): ?>
	<a href="viewLoans.php">All</a>
<?php else: ?>
	<b>All </b>
<?php endif; ?>
|
<?php if ($this->_tpl_vars['filter'] != 'outstanding'): ?>
	<a href="viewLoans.php?view=outstanding">Outstanding</a>
<?php else: ?>
	<b>Outstanding </b>
<?php endif; ?>
|
<?php if ($this->_tpl_vars['filter'] != 'returned'): ?>
	 <a href="viewLoans.php?view=returned">Returned</a>
<?php else: ?>
	<b>Returned </b>
<?php endif; ?>
</span></div>


<table width="800" border="0" class="itemsTable" cellspacing="0">
	<tr>
	
	 		<th width="250">
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'description' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=description&sortdir=DESC">
		    Item
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'description' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		    <a class="tableHeaderLink" href="viewLoans.php?sort=description">
		    Item
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=description">
		    Item
		  </a>
		<?php endif; ?>
		</th>
		
				<th>
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'starting_condition' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=starting_condition&sortdir=DESC">
		    Starting Condition
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'starting_condition' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=starting_condition">
		    Starting Condition
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=starting_condition">
		    Starting Condition
		  </a>
		<?php endif; ?>
		</th>
		
				<th>
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'username' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=username&sortdir=DESC">
		    Borrower
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'username' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=username">
		    Borrower
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=username">
		    Borrower
		  </a>
		<?php endif; ?>
		</th>
		
				<th>
				<?php if (! isset ( $this->_tpl_vars['sort'] )): ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=issue_date">
		    Loan Date
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'issue_date' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=issue_date&sortdir=DESC">
		    Loan Date
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'issue_date' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=issue_date">
		    Loan Date
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=issue_date">
		    Loan Date
		  </a>
		<?php endif; ?>
		</th>
		
				<th width="100">
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'return_date' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=return_date&sortdir=DESC">
		    Return Date
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'return_date' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=return_date">
		    Return Date
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="viewLoans.php?sort=return_date">
		    Return Date
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

	<td><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->description; ?>
</td>
	<td><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->starting_condition; ?>
</td>
	<td><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->username; ?>
</td>
	<td><?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->issue_date; ?>
</td>
	<td align="center">
	<?php if ($this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->return_date == NULL && $this->_tpl_vars['authority'] >= 1): ?>
		<a href="returnItem.php?id=<?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->loan_id; ?>
">Return</a>
	<?php elseif ($this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->return_date == NULL): ?>
		Out
	<?php else: ?>
		<?php echo $this->_tpl_vars['items'][$this->_sections['itemLoop']['index']]->return_date; ?>

	<?php endif; ?>
	
	</td>
</tr>
<?php endfor; endif; ?>	


</table>