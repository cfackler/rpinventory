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

require_once("lib/connect.lib.php");  //mysql
require_once("lib/auth.lib.php");  //authentication


$link = connect();
if($link == null)
	die("Database connection failed");
	


//------- Page section --------

//Authenticate user
if(!Authenticate($_POST["username"], $_POST["password"], $link))
{
	//Logout and kill session
	Logout();
    
    header("location: login.php?login=fail");
    
    mysqli_close($link);
    die();
}

//Redirect to main page
header("location: viewInventory.php");

mysqli_close($link);

?>