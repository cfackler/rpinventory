<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RPI Inventory</title>
<link rel="stylesheet" href="css/styles.css" type="text/css" />

<script src="ExternalJS.js" language="javascript" type="text/javascript"></script>
    
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

</head>

	<body>
	    <div class="header">
			<h1>RPInventory</h1>
	    </div>
		
	    <div class="left_sidebar">
		    <a href="index.php">Home</a> <br />
		    <a href="viewinventory.php">View Inventory</a> <br />
		    <a href="viewBorrowers.php">View Borrowers</a> <br />
		    <a href="viewLoans.php">View Loans</a> <br />
		    <a href="repairs.html">View Repairs</a> <br />
		    <a href="purchases.html">View Purchases</a> <br />
		    <a href="businesses.html">View Businesses</a> <br />
			
			{if $authority >= 1}
				<br>
				<a href="manageLocations.php">Manage Locations</a> <br />
			{/if}
			
			{if $authority == 2}
				<br>
				<b>Admin</b><br>
				<a href="manageusers.php">Manage Users</a> <br />
			{/if}
			
			<br>
			{if $authority == null}
				<a href="login.php">Login</a> <br />
			{else}
				<a href="logout.php">Logout</a> <br />
			{/if}
			
	    </div>

	    <div class="main_body">
			{include file="$page_tpl.tpl"}
	    </div>

	</body>
</html>




