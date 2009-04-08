<?php /* Smarty version 2.6.22, created on 2009-04-15 15:20:10
         compiled from manageUsers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'manageUsers.tpl', 134, false),)), $this); ?>
<div class="TopOfTable"><span class="TopOfTable">
<h3>Users</h3>
<a href="addUser.php">Add new user</a>
</span></div>

<table width="900" border="0" class="itemsTable" cellspacing="0">
	<tr>
		
				<th>
				<?php if (! isset ( $this->_tpl_vars['sort'] )): ?>
		  <a class="tableHeaderLink" href="?sort=name&sortdir=DESC">
		    Name
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'name' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="?sort=name&sortdir=DESC">
		    Name
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'name' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="?sort=name">
		    Name
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="?sort=name">
		    Name
		  </a>
		<?php endif; ?>
		</th>
		
				<th width="100">
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'username' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="?sort=username&sortdir=DESC">
		    Username
		    <img src="images/sortTriangleUp.png" />
      </a>
    <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'username' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
      <a class="tableHeaderLink" href="?sort=username">
		    Username
		    <img src="images/sortTriangleDown.png" />
      </a>
    <?php else: ?>
      <a class="tableHeaderLink" href="?sort=username">
		    Username
      </a>
    <?php endif; ?>
    </th>
    
    		<th width="100">
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'access_level' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="?sort=access_level&sortdir=DESC">
		    Access
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'access_level' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="?sort=access_level">
		    Access
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="?sort=access_level">
		    Access
		  </a>
		<?php endif; ?>
		</th>
		
				<th width="100">
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'rin' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="?sort=rin&sortdir=DESC">
		    RIN
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'rin' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="?sort=rin">
		    RIN
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="?sort=rin">
		    RIN
		  </a>
		<?php endif; ?>
		</th>
		
				<th width="150">
		<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'email' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		  <a class="tableHeaderLink" href="?sort=email&sortdir=DESC">
		    Email
		    <img src="images/sortTriangleUp.png" />
		  </a>
		<?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'email' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		  <a class="tableHeaderLink" href="?sort=email">
		    Email
		    <img src="images/sortTriangleDown.png" />
		  </a>
		<?php else: ?>
		  <a class="tableHeaderLink" href="?sort=email">
		    Email
		  </a>
		<?php endif; ?>
		</th>
		
				<th width="150">Actions</th>
	</tr>

<?php unset($this->_sections['userLoop']);
$this->_sections['userLoop']['name'] = 'userLoop';
$this->_sections['userLoop']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['userLoop']['show'] = true;
$this->_sections['userLoop']['max'] = $this->_sections['userLoop']['loop'];
$this->_sections['userLoop']['step'] = 1;
$this->_sections['userLoop']['start'] = $this->_sections['userLoop']['step'] > 0 ? 0 : $this->_sections['userLoop']['loop']-1;
if ($this->_sections['userLoop']['show']) {
    $this->_sections['userLoop']['total'] = $this->_sections['userLoop']['loop'];
    if ($this->_sections['userLoop']['total'] == 0)
        $this->_sections['userLoop']['show'] = false;
} else
    $this->_sections['userLoop']['total'] = 0;
if ($this->_sections['userLoop']['show']):

            for ($this->_sections['userLoop']['index'] = $this->_sections['userLoop']['start'], $this->_sections['userLoop']['iteration'] = 1;
                 $this->_sections['userLoop']['iteration'] <= $this->_sections['userLoop']['total'];
                 $this->_sections['userLoop']['index'] += $this->_sections['userLoop']['step'], $this->_sections['userLoop']['iteration']++):
$this->_sections['userLoop']['rownum'] = $this->_sections['userLoop']['iteration'];
$this->_sections['userLoop']['index_prev'] = $this->_sections['userLoop']['index'] - $this->_sections['userLoop']['step'];
$this->_sections['userLoop']['index_next'] = $this->_sections['userLoop']['index'] + $this->_sections['userLoop']['step'];
$this->_sections['userLoop']['first']      = ($this->_sections['userLoop']['iteration'] == 1);
$this->_sections['userLoop']['last']       = ($this->_sections['userLoop']['iteration'] == $this->_sections['userLoop']['total']);
?>
<tr<?php echo smarty_function_cycle(array('values' => " class=\"alt\","), $this);?>
>
	<td align="center"><?php echo $this->_tpl_vars['users'][$this->_sections['userLoop']['index']]->name; ?>
</td>
	<td align="center"><?php echo $this->_tpl_vars['users'][$this->_sections['userLoop']['index']]->username; ?>
</td>
	<td align="center">
	<?php if ($this->_tpl_vars['users'][$this->_sections['userLoop']['index']]->access_level == 2): ?>
		Administrator
	<?php elseif ($this->_tpl_vars['users'][$this->_sections['userLoop']['index']]->access_level == 1): ?>
		Manager
	<?php else: ?>
		User
	<?php endif; ?>
		
	</td>
	
	
	<td align="center"><?php echo $this->_tpl_vars['users'][$this->_sections['userLoop']['index']]->rin; ?>
</td>
	<td align="center"><?php echo $this->_tpl_vars['users'][$this->_sections['userLoop']['index']]->email; ?>
</td>
	
	<td align="center"><a href="editUser.php?id=<?php echo $this->_tpl_vars['users'][$this->_sections['userLoop']['index']]->id; ?>
">Edit</a> or <input type="button" onclick="confirmation('Are you sure you want to delete user <?php echo $this->_tpl_vars['users'][$this->_sections['userLoop']['index']]->username; ?>
 ?','deleteUser.php?id=<?php echo $this->_tpl_vars['users'][$this->_sections['userLoop']['index']]->id; ?>
')" value="Delete User"></td>
</tr>
<?php endfor; endif; ?>	


</table>