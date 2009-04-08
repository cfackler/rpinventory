<?php /* Smarty version 2.6.22, created on 2009-04-15 14:48:17
         compiled from index.tpl */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RPI Inventory</title>
<link rel="stylesheet" href="css/styles.css" type="text/css" />

<script src="ExternalJS.js" language="javascript" type="text/javascript"></script>
<script src="prototype.js" language="javascript" type="text/javascript"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

</head>

	<body>
	    <div class="header">
			<?php 
				require_once('lib/config.class.php');
				$this->assign('clubName', Config::get('club_name'));
			 ?>
			<span class="headerContent"><?php echo $this->_tpl_vars['clubName']; ?>
</span>
	    </div>
		
	    <div class="left_sidebar">
	    	 <ul>
			<li class="nonLinkSidebarItem">Home</li>
			<li><a href="viewInventory.php">View Inventory</a></li>
			<?php if ($this->_tpl_vars['authority'] >= 1): ?>
		             <li><a href="viewBorrowers.php">View Borrowers</a></li>
		    	     <li><a href="viewLoans.php">View Loans</a></li>
			     <?php if ($this->_tpl_vars['authority'] == 2): ?>
		    	     <li><a href="viewRepairs.php">View Repairs</a></li>
		    	     <li><a href="viewPurchases.php">View Purchases</a></li>
		    	     <li><a href="viewBusinesses.php">View Businesses</a></li>
			     <?php endif; ?>
			     
			     <li><br /></li>
			     <li class="nonLinkSidebarItem">Admin</li>
			     <li><a href="manageLocations.php">Manage Locations</a></li>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['authority'] == 2): ?>
			     <li><a href="manageUsers.php">Manage Users</a></li>
			     <li><a href="generateSummary.php">Create Summary</a></li>
			     <li><a href="backupDatabase.php">Create Backup</a></li>
			<?php endif; ?>
			
			<li><br /></li>
			
			<?php if ($this->_tpl_vars['authority'] == null): ?>
			     <li><a href="login.php">Login</a></li>
			<?php else: ?>
			     <li><a href="logout.php">Logout</a></li>
			<?php endif; ?>
		</ul>
			
	    </div>

	    <div class="main_body">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['page_tpl']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	    </div>

	</body>
</html>