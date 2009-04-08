<?php /* Smarty version 2.6.22, created on 2009-04-14 20:45:25
         compiled from login.tpl */ ?>

<form name="inventoryLogin" id="inventoryLogin" action="authenticate.php" method="post">	
<center>

	<?php if ($this->_tpl_vars['loginStatus'] == 'fail'): ?>
		<h3>Login Failed</h3>
	<?php endif; ?>	

	<table cellspacing="5">	
		<tr>
			<td width="100">Username</td>
			<td><input type="text" name="username" id="username"></td>
		</tr>
		<tr>
			<td width="100">Password</td>
			<td><input type="password" name="password" id="password"></td>
		</tr>
	</table>

	<br>

	<input type="submit" value="Login">

</center>