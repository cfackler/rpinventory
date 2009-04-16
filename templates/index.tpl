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
{php
require_once('lib/config.class.php');
$this->assign('clubName', Config::get('club_name'));
{/php}
<title>{$clubName} - RPInventory</title>

<link rel="stylesheet" href="css/styles.css" type="text/css" />
<script src="ExternalJS.js" language="javascript" type="text/javascript"></script>
<script src="prototype.js" language="javascript" type="text/javascript"></script>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

</head>

	<body>
	    <div class="header">
			{php}
				require_once('lib/config.class.php');
				$this->assign('clubName', Config::get('club_name'));
			{/php}
			<span class="headerContent">{$clubName}</span>
	    </div>
		
	    <div class="navigationBar">
	    	 <ul>
			<li class="SidebarSectionHeader">Home</li>
			<li><a href="viewInventory.php">View Inventory</a></li>
			{if $authority >= 1}
		             <li><a href="viewBorrowers.php">View Borrowers</a></li>
		    	     <li><a href="viewLoans.php">View Loans</a></li>
			     <li><a href="viewCheckouts.php">View Checkouts</a></li>
			     {if $authority == 2}
		    	     <li><a href="viewRepairs.php">View Repairs</a></li>
		    	     <li><a href="viewPurchases.php">View Purchases</a></li>
		    	     <li><a href="viewBusinesses.php">View Businesses</a></li>
			     {/if}
			     
			     <li><br /></li>
			     <li class="SidebarSectionHeader">Admin</li>
			     <li><a href="manageLocations.php">Manage Locations</a></li>
			{/if}
			
			{if $authority == 2}
			     <li><a href="manageUsers.php">Manage Users</a></li>
			     <li><a href="generateSummary.php">Create Summary</a></li>
			     <li><a href="backupDatabase.php">Create Backup</a></li>
			{/if}
			
			<li><br /></li>
			
			{if $authority == null}
			     <li><a href="login.php">Login</a></li>
			{else}
			     <li><a href="logout.php">Logout</a></li>
			{/if}
		</ul>
			
	    </div>

	    <div class="main_body">
			{include file="$page_tpl.tpl"}
	    </div>

	</body>
</html>
