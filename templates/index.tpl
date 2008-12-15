{*
    Copyright (C) 2008, All Rights Reserved.

    This file is part of RPInventory.

    RPInventory is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    RPInventory is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with RPInventory.  If not, see <http://www.gnu.org/licenses/>.

*}

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
			<h1>RPInventory</h1>
	    </div>
		
	    <div class="left_sidebar">
		    <a href="index.php">Home</a> <br />
		    <a href="viewInventory.php">View Inventory</a> <br />
		    <a href="viewBorrowers.php">View Borrowers</a> <br />
		    <a href="viewLoans.php">View Loans</a> <br />
		    <a href="viewRepairs.php">View Repairs</a> <br />
		    <a href="viewPurchases.php">View Purchases</a> <br />
		    <a href="viewBusinesses.php">View Businesses</a> <br />
			
			{if $authority >= 1}
				<br>
                <b>Admin</b><br>
				<a href="manageLocations.php">Manage Locations</a> <br />
			{/if}
			
			{if $authority == 2}
				<a href="manageUsers.php">Manage Users</a> <br />
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




