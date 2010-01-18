<?php

/*

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

*/

require_once("lib/auth.lib.php");  //Session
require_once('lib/clubs.lib.php');
require_once('lib/users.lib.php');
require_once('class/database.class.php');

function array_obj_diff ($array1, $array2) {
    $usernames = array();
    $usernames_remove = array();
    $result = array();

    // All usernames
    foreach ($array1 as &$obj)
    {
        array_push($usernames, $obj->username);
    }

    // All usernames to remove
    foreach ($array2 as &$obj)
    {
        if (in_array($obj->username, $usernames))
        {
            array_push($usernames_remove, $obj->username);
        }
    }

    for ($i=0; $i<count($usernames); $i++)
    {
        if (in_array($usernames[$i], $usernames_remove))
        {
            array_shift($array1);
        }
        else
        {
            array_push($result, array_shift($array1));
        }
    }
   
    return $result;
}

// Connect
$db = new database();

//Authenticate
$auth = GetAuthority();	
if ($auth != 2)
{
	die( 'Permission Denied' );
}

// SMARTY Setup
require_once('lib/smarty_inv.class.php');
$smarty = new Smarty_Inv();

$id = (int)$_GET['id'];
if ($id == 0)
{
    die("Invalid ID Given");
}

//club
$club = getClub($id, $db);

if ($club == false)
{
    die("Could not get information");
}

$users = getAllUsers($db);
$club_users = getClubUsers($id, $db);

$display_users = array_obj_diff($users, $club_users);

//Assign vars
$smarty->assign('title', "Edit Club");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'editClub');
$smarty->assign('club', $club);
$smarty->assign('users', $club_users);
$smarty->assign('newUsers', $display_users);

$smarty->display('index.tpl');

$db->close();

?>
