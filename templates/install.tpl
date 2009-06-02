{*
Copyright (C) 2009, All Rights Reserved.

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
      <span class="headerContent">RPInventory</span>
    </div>
    
    <div class="main_body" style="padding-right: 200px;">
      <h1>RPInventory Installation</h1>
      {if isset($error)}
        <h2>{$error}</h2>
      {/if}
      <p>Edit the file <pre>config/config.ini.php.dist</pre> to set your site-specific database server options. Save the modified file to <pre>config/config.ini.php</pre> and make sure it is readable by the webserver. It would be a good idea to make sure this file is not readable by anyone else and definitely not writable by anyone.</p>
      <p><strong>Be sure to complete the above before continuing.</strong></p>
      <hr />
      <form id="installForm" name="installForm" action="install.php" method="post">
	<p>The database and database user specified in the configuration file will be created by this installer. Enter the name of a database user who has CREATE and GRANT permissions on the database server specified in the config file. This user will be used to create or modify the RPInventory database.<br />
	  <input type="text" name="superuser" id="superuser" size="20" /></p>
	<p>Enter the password for this database user.<br />
	  <input type="password" name="superpass" id="superpass" size="20" /></p>
	<hr />
	<p>This installer will create a user for the RPInventory system, giving them administrative privileges. Please enter a username to create.<br />
	  <input type="text" name="adminuser" id="adminuser" size="20" /></p>
	<p>Please enter a password to create for the administrative user.<br />
	  <input type="password" name="adminpass1" id="adminpass1" size="20" /></p>
	<p>Retype password.<br />
	  <input type="password" name="adminpass2" id="adminpass2" size="20" /></p>
      	<input type="submit" name="install" value="Install" />
      </form>
    </div>
  </body>
</html>
