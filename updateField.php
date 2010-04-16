<?php

/*

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

 */


require_once('lib/auth.lib.php');  //Session
require_once('lib/fields.lib.php');
require_once('class/database.class.php');

//Authenticate
$auth = GetAuthority();
if ($auth < 2)
{
    die('You dont have permission to access this page');
}

// Connect
$db = new database();

$id = (int)$_POST['id'];
if ($id == 0)
{
    die('Invalid ID');
}

$name = $_POST['name'];

$clubId = (int)$_SESSION['club'];

if ($clubId < 1)
{
    die('Invalid club id');
}

$fields = getClubCustomFields($clubId, $db);

foreach($fields as &$field)
{
    if (strcasecmp($field->field_name, $name) == 0)
    {
        die('Duplicate name given. Please enter a new name');
    }
}

updateFieldName($id, $name, $db);

$db->close();

header('Location: manageCustomFields.php');

?>
