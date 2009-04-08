<?php /* Smarty version 2.6.22, created on 2009-04-15 11:09:03
         compiled from viewBorrowers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'viewBorrowers.tpl', 134, false),)), $this); ?>
<div class="TopOfTable">
<span class="TopOfTable">
<h3>Borrowers</h3>
</span>
</div>

<?php if ($this->_tpl_vars['authority'] >= 1): ?>
    <table width="800" border="0" cellspacing="0" class="itemsTable">
    	<tr>
    	
        <th width="150">
        <?php if (! isset ( $this->_tpl_vars['sort'] )): ?>
      <a class="tableHeaderLink" href="viewBorrowers.php?sort=name&sortdir=DESC">
        Name
        <img src="images/sortTriangleUp.png" />
      </a>
    <?php elseif ($this->_tpl_vars['sort'] == 'name' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
      <a class="tableHeaderLink" href="viewBorrowers.php?sort=name&sortdir=DESC">
        Name
        <img src="images/sortTriangleUp.png" />
      </a>
    <?php elseif ($this->_tpl_vars['sort'] == 'name' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
      <a class="tableHeaderLink" href="viewBorrowers.php?sort=name">
        Name
        <img src="images/sortTriangleDown.png" />
      </a>
    <?php else: ?>
      <a class="tableHeaderLink" href="viewBorrowers.php?sort=name">
        Name
      </a>
    <?php endif; ?>
    </th>
    
    		<th width="100">
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'rin' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=rin&sortdir=DESC">
		    RIN
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'rin' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=rin">
		    RIN
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		    <a class="tableHeaderLink" href="viewBorrowers.php?sort=rin">
		    RIN
		  </a>
		<?php endif; ?>
		</th>
		
				<th width="150">
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'email' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=email&sortdir=DESC">
		    Email
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'email' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=email">
		    Email
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=email">
		    Email
		  </a>
		<?php endif; ?>
		</th>
		
				<th>
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'address' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=address&sortdir=DESC">
		    Address
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'address' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=address">
		    Address
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=address">
		    Address
		  </a>
		<?php endif; ?>		
		</th>
		
				<th width="100">
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'phone' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=phone&sortdir=DESC">
		    Phone
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'phone' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=phone">
		    Phone
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="viewBorrowers.php?sort=phone">
		    Phone
		  </a>
		<?php endif; ?>
		</th>

	</tr>

	<?php unset($this->_sections['num']);
$this->_sections['num']['name'] = 'num';
$this->_sections['num']['loop'] = is_array($_loop=$this->_tpl_vars['borrowers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td align="center"><?php echo $this->_tpl_vars['borrowers'][$this->_sections['num']['index']]->name; ?>
</td>
		<td align="center"><?php echo $this->_tpl_vars['borrowers'][$this->_sections['num']['index']]->rin; ?>
</td>
		<td align="center"><?php echo $this->_tpl_vars['borrowers'][$this->_sections['num']['index']]->email; ?>
</td>
		
		<td align="center">
			<?php echo $this->_tpl_vars['borrowers'][$this->_sections['num']['index']]->address; ?>
<br>
			
			<?php if ($this->_tpl_vars['borrowers'][$this->_sections['num']['index']]->address2 != NULL): ?>
			<?php echo $this->_tpl_vars['borrowers'][$this->_sections['num']['index']]->address2; ?>
<br>
			<?php endif; ?>
			
			<?php echo $this->_tpl_vars['borrowers'][$this->_sections['num']['index']]->city; ?>
, <?php echo $this->_tpl_vars['borrowers'][$this->_sections['num']['index']]->state; ?>
 <?php echo $this->_tpl_vars['borrowers'][$this->_sections['num']['index']]->zipcode; ?>
<br>
		</td>
		
		<td align="center"><?php echo $this->_tpl_vars['borrowers'][$this->_sections['num']['index']]->phone; ?>
</td>
		
	</tr>
	<?php endfor; endif; ?>
    </table>
<?php else: ?>
    <p>Please login if you wish to view information about borrowers</p>
<?php endif; ?>