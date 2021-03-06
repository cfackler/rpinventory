{*
    Copyright (C) 2010, All Rights Reserved.

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

{php}
$this->assign('clubName', $_SESSION['club_name']);
{/php}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{if $authority > 0}{$clubName} - {/if}RPInventory</title>

<link rel="stylesheet" href="js/modulesJS/jquery-ui-1.7.2.custom/css/custom-theme/jquery-ui-1.7.2.custom.css" type="text/css" />
<link rel="stylesheet" href="css/styles.css" type="text/css" />
<script src="js/modulesJS/prototype.js" language="javascript" type="text/javascript"></script>
<script src="js/modules.js" language="javascript" type="text/javascript"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<script src="js/ExternalJS.js" language="javascript" type="text/javascript"></script>
<script src="js/helpToolTip.js" language="javascript" type="text/javascript"></script>
<link rel="stylesheet" href="js/modulesJS/asmselect/jquery.asmselect.css" type="text/css" />

<script src="js/functions.interface.js" language="javascript" type="text/javascript"></script>

{if !isset($emptyTable)}
    {if file_exists("js/"|cat:$page_tpl|cat:".interface.js") }
        <script src={'"js/'|cat:$page_tpl|cat:'.interface.js"'} language="javascript" type="text/javascript"></script>
    {else}
        <script src="js/default.interface.js" language="javascript" type="text/javascript"></script>
    {/if}
{else}
    <script src="js/buttons.interface.js" language="javascript" type="text/javascript"></script>
{/if}

{if $page_tpl == 'login'}
    <script>{php}echo "(jQuery)(document).ready(function() { (jQuery)('#username').focus();});"{/php}</script>
{/if}

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

</head>
	<body>
	  <div class="bodyContainer" id="bodyContainer">
	    <div class="header ui-widget ui-widget-header ui-corner-all">
            {if $authority > 0}
			<span class="headerContent">{$clubName}</span>
            {else}
            <span class="headerContent">RPInventory</span>
            {/if}
	    </div>
		
	    <div class="navigationBar ui-widget ui-widget-content ui-corner-all">
	    	 <ul class="ui-corner-all navigationList">
			<li class="ui-widget-header ui-corner-all navigationHeader">Home</li>
			{if $page_tpl == 'viewInventory'}
				<li class="ui-state-default ui-corner-all ui-state-active">
			{else}
				<li class="ui-state-default ui-corner-all">
			{/if}
			<a id="viewInventory" href="viewInventory.php">Inventory</a></li>
			{if $authority > 0}
				{if $page_tpl == 'viewLoans'}
					<li class="ui-state-default ui-corner-all ui-state-active">
				{else}
					<li class="ui-state-default ui-corner-all">
				{/if}

				<a id="viewLoans" href="viewLoans.php">Loans</a></li>

				{if $page_tpl == 'viewCheckouts'}
					<li class="ui-state-default ui-corner-all ui-state-active">
				{else}
			        <li class="ui-state-default ui-corner-all">
				{/if}

				<a id="viewCheckouts" href="viewCheckouts.php">Checkouts</a></li>

			    {if $authority > 1}
						{if $page_tpl == 'viewRepairs'}
							<li class="ui-state-default ui-corner-all ui-state-active">
						{else}
							<li class="ui-state-default ui-corner-all">
						{/if}

						<a id="viewRepairs" href="viewRepairs.php">Repairs</a></li>

		    	        {if $page_tpl == 'viewPurchases'}
					        <li class="ui-state-default ui-corner-all ui-state-active">
						{else}
							<li class="ui-state-default ui-corner-all">
						{/if}

						<a id="viewPurchases" href="viewPurchases.php">Purchases</a></li>

						{if $page_tpl == 'viewBusinesses'}
							<li class="ui-state-default ui-corner-all ui-state-active">
						{else}
							<li class="ui-state-default ui-corner-all">
						{/if}
						
                        <a id="viewBusinesses" href="viewBusinesses.php">Businesses</a></li>
			    {/if}
			     
			    <li>
                    <br />
                </li>

			    <li class="ui-widget-header ui-corner-all navigationHeader">Admin</li>
				{if $page_tpl == 'manageLocations'}
					<li class="ui-state-default ui-corner-all ui-state-active">
				{else}
					<li class="ui-state-default ui-corner-all">
				{/if}

				<a id="manageLocations" href="manageLocations.php">Locations</a></li>

				{if $page_tpl == 'manageBorrowers'}
					<li class="ui-state-default ui-corner-all ui-state-active">
				{else}
					<li class="ui-state-default ui-corner-all">
				{/if}

				<a id="manageBorrowers" href="manageBorrowers.php">Borrowers</a></li>
			{/if}
			
			{if $authority > 1}
                {if $page_tpl == 'manageCustomFields'}
                    <li class="ui-state-default ui-corner-all ui-state-active">
                {else}
                    <li class="ui-state-default ui-corner-all">
                {/if}
                <a id="manageCustomFields" href="manageCustomFields.php">Custom Fields</a></li>
				{if $page_tpl == 'manageUsers'}
					<li class="ui-state-default ui-corner-all ui-state-active">
				{else}
					<li class="ui-state-default ui-corner-all">
				{/if}
				<a id="manageUsers" href="manageUsers.php">Users</a></li>
				{if $page_tpl == 'generateSummary'}
					<li class="ui-state-default ui-corner-all ui-state-active">
				{else}
					<li class="ui-state-default ui-corner-all">
				{/if}
				<a id="generateSummary" href="generateSummary.php">Summary</a></li>
			{/if}

            {if $authority > 2}
			     <li><br /></li>
			     <li class="ui-widget-header ui-corner-all navigationHeader">Management</li>
                {if $page_tpl == 'manageClubs'}
                    <li class="ui-state-default ui-corner-all ui-state-active">
                {else}
                    <li class="ui-state-default ui-corner-all">
                {/if}
                <a id="manageClubs" href="manageClubs.php">Clubs</a></li>
                {if $page_tpl == 'backupDatabase'}
					<li class="ui-state-default ui-corner-all ui-state-active">
				{else}
			        <li class="ui-state-default ui-corner-all">
				{/if}
				<a id="backupDatabase" href="backupDatabase.php">Backup</a></li>
            {/if}
			
			<li><br /></li>
			
			{if $authority == null}
			     <li class="ui-state-default ui-corner-all"><a href="login.php">Login</a></li>
			{else}
			     <li class="ui-state-default ui-corner-all"><a href="logout.php">Logout</a></li>
			{/if}
		</ul>
			
	    </div>

	    <div class="main_body">
			{include file="$page_tpl.tpl"}
	    </div>
    </div>
	</body>
</html>
