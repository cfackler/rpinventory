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

// start session
session_start(); 

function Authenticate($username, $password, $clubID, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    //Find user
    
    $sql = 'SELECT l.id, uc.access_level, clubs.club_name FROM users, user_clubs uc, clubs WHERE users.user_id=uc.user_id AND uc.club_id = ? AND users.username = ? AND users.password= ? AND uc.club_id=clubs.club_id';

    $result = $db->query($sql, $clubID, $username, md5($password));

    //verify count
    if(mysqli_num_rows($result) == 0)
        return false;

    $row = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    //Verify row
    if($row == false)
        return false;

    //Store id, auth, club id, and club name
    $_SESSION['id'] = $row->id;
    $_SESSION['authority'] = $row->access_level;
    $_SESSION['club'] = $clubID;
    $_SESSION['club_name'] = $row->club_name;

    return true;
}

function Logout()
{
    unset($_SESSION['id']);
    unset($_SESSION['authority']);
    unset($_SESSION['club']);
    unset($_SESSION['club_name']);

    @session_destroy();
}

//Verify id and authority set
function IsAuthenticated()
{
    if(isset($_SESSION['id']) && isset($_SESSION['authority']) && isset($_SESSION['club']) && isset($_SESSION['club_name']))
        return true;

    Logout();
    return false;
}

function GetAuthority()
{
    if(!IsAuthenticated())
        return null;

    return $_SESSION['authority'];
}

?>
