<form name="inventoryLogin" id="inventoryLogin" action="authenticate.php" method="post">	
<center>

	{if $loginStatus == "fail"}
		<h3>Login Failed</h3>
	{/if}	

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