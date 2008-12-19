<?php

/*

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

*/

if (isset($_POST['submit']))		// form was submitted, setup database
{
	$hostname = $_POST['hostname'];
	$database = $_POST['database'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$superuser = $_POST['superuser'];
	$superpass = $_POST['superpass'];

	$link = mysqli_connect($hostname,$superuser,$superpass);
	if ($link == false)
		die("Could not connect to database server");
	
	// create database
	mysqli_query($link, "CREATE DATABASE IF NOT EXISTS`" . $database . "`");
	
	// add user
	mysqli_query($link, "GRANT SELECT,INSERT,UPDATE,DELETE ON " . $database . ".* TO '" . $username . "'@'" . $hostname . "' IDENTIFIED BY '" . $password . "'");
	mysqli_select_db($link, $database);
	
	// read in setup sql and create database structure
	$sql = file_get_contents('setup.sql');
	mysqli_multi_query($link, $sql);
	
	// create first admin user
	$sql = "INSERT INTO logins (id, username, password, access_level, rin, email, name) VALUES ";
	$sql .= "(NULL, 'admin', '" . md5('admin') . "', 2, '0', 'admin', 'admin')";
	
	mysqli_query($link, $sql);
	
	// close connection
	mysqli_close($link);
	
	// generate config string
	$config = "<?php\n";
	$config .= '$hostname = \'' . $hostname . "';\n";
	$config .= '$username = \'' . $username . "';\n";
	$config .= '$password = \'' . $password . "';\n";
	$config .= '$database = \'' . $database . "';\n";
	$config .= "?>\n";
	
	// write out config file
	$handle = fopen(realpath('./../inc/') . '/config.php', 'w');
	if (!fwrite($handle, $config))
		die("Could not write config file, installation failed");
	
	print '<p>Setup successful!</p><p>Created user admin with password admin...be sure to change the defaults</p><p><a href="../index.php">Use RPInventory!</a></p>';
	exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RPI Inventory</title>
<link rel="stylesheet" href="css/styles.css" type="text/css" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

</head>
<body>
	<div class="header">
		<h1>RPInventory</h1>
	</div>
	<div class="main_body">
	<p>Welcome to RPInventory. Fill out the information below to set up your database server and install the application.</p>
	<form name="setup" method="post" action="setup.php">
		<table>
			<tr>
				<td><label for="hostname">Database Server (i.e. localhost): </label></td>
				<td><input type="text" name="hostname" /></td>
			</tr>
			<tr>
				<td><label for="database">Database Name: </label></td>
				<td><input type="text" name="database" /></td>
			</tr>
			<tr>
				<td><label for="username">Database user to create: </label></td>
				<td><input type="text" name="username" /></td>
			</tr>
			<tr>
				<td><label for="password">Database password for above user: </label></td>
				<td><input type="password" name="password" /></td>
			</tr>
			<tr>
				<td><label for="superuser">Database user with create/grant permission: </label></td>
				<td><input type="text" name="superuser" /></td>
			</tr>
			<tr>
				<td><label for="superpass">Password for create/grant user: </label></td>
				<td><input type="password" name="superpass" /></td>
			</tr>
		</table>
		
		<input type="submit" name="submit" value="Install RPInventory!" />
	</form>
	</div>
</body>
</html>
