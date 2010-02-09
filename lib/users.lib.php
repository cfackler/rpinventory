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

function getUser($user_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'SELECT * FROM users WHERE user_id = ?';

    $result = $db->query($sql, $user_id);

    $user = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $user;
}

function getAllUsers($db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    require_once("lib/auth.lib.php");  //Session

    // Authenticate
    $auth = GetAuthority();

    // Users
    $query = "SELECT * FROM users";

    $result = $db->query($query);

    $records = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }
  
    return $records;
}

function getUserFromName($username, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    // Users
    $query = "SELECT * FROM users WHERE username = ? LIMIT 1";

    $result = $db->query($query, $username);

    $record = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }
  
    return $record;

}

function getAllUsernames($db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    require_once("lib/auth.lib.php");  //Session

    // Authenticate
    $auth = GetAuthority();

    // Users
    $query = "SELECT username FROM users";

    $result = $db->query($query);

    $records = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }
  
    return $records;
}

function getUsers($db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    require_once("lib/auth.lib.php");  //Session

    if (!isset($_SESSION['club']))
    {
        return array();
    }

    $clubId = (int)$_SESSION['club'];

    // Authenticate
    $auth = GetAuthority();

    // Users
    $query = "SELECT username, email FROM users, user_clubs WHERE user_clubs.user_id = users.user_id AND user_clubs.club_id = ?";

    $result = $db->query($query, $clubId);

    $records = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }
  
    return $records;
}

function getUsernames($name, $db = null)
{
    require_once( 'modules/json/JSON.php' );
    require_once( 'lib/auth.lib.php' );

    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    if (!isset($_SESSION['club']))
    {
        header('X-JSON: ('.$json->encode('').')');
        exit();
    }

    $club_id = $_SESSION['club'];
  
    // Authenticate
    $auth = GetAuthority();
    if($auth < 1)
        die("You dont have permission to access this page");

    $sql = 'SELECT username FROM users';

    $result = $db->query($sql);

    $users = $db->getObjectArray($result);
    $records = array();

    foreach($users as &$record)
    {
        if ( preg_match( '!^'.$name.'!', $record->username ) ) {
            $records[] = $record->username;
        }
    }

    $data = array( "records" => $records );

    if ($close)
    {
        $db->close();
    }

    $json = new Services_JSON();

    header('X-JSON: ('.$json->encode( $data ).')');
}

function getViewUsers($currentSortIndex=0, $currentSortDir=0, $db = null)
{
    require_once("lib/auth.lib.php");  //Session

    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    // Authenticate
    $auth = GetAuthority();

    // Need to be administrator 
    if ($auth < 2)
    {
        return array();
    }

    /* Determine query argument for sorting */
    if($currentSortIndex == 0)
        $sortBy = 'username';
    else if($currentSortIndex == 1)
        $sortBy = 'access_level';
    else if($currentSortIndex == 2)
        $sortBy = 'email';

    /*  Determine query argument for sort direction
        Ascending is default    */
    if($currentSortDir == 1)
        $sortBy .= ' DESC';

    if (!isset($_SESSION['club']))
    {
        return array();
    }  

    $clubId = $_SESSION['club'];

    //users
    $sql = "SELECT * from users, user_clubs WHERE user_clubs.user_id = users.user_id AND user_clubs.club_id = ? ORDER BY ".$sortBy;

    $result = $db->query($sql, $clubId);

    $users = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $users;
}

// Add a new user and link them to the current club
function addUser($username, $password, $accessLevel, $email, $clubId, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    // Insert the new user
    $sql = 'INSERT INTO users (user_id, username, password, email) VALUES (NULL, ?, ?, ?)';
    $db->query($sql, $username, $password, $email);

    // Link the user to the current club
    $sql = 'INSERT INTO user_clubs (user_id, club_id, access_level) VALUES (?, ?, ?)';
    $db->query($sql, $db->insertId(), $clubId, $accessLevel);

    if ($close)
    {
        $db->close();
    }

    return;
}

function deleteUser($user_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'DELETE FROM users WHERE user_id = ? LIMIT 1';

    $db->query($sql, $user_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

function updateUser($user_id, $username, $email, $password, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'UPDATE users SET username = ?, email = ?, password = ? WHERE user_id = ?';

    $db->query($sql, $username, $email, $password, $user_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

function getClubUsers($club_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'SELECT user_clubs.user_id, username, access_level FROM user_clubs, users WHERE club_id = ? AND users.user_id = user_clubs.user_id';

    $result = $db->query($sql, $club_id);

    $users = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $users;
}

function getClubUsernames($club_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    $sql = 'SELECT username FROM user_clubs, users WHERE club_id = ? AND users.user_id = user_clubs.user_id';

    $result = $db->query($sql, $club_id);

    $users = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $users;
}

function addUserToClub($user_id, $club_id, $accessLevel, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    // Link the user to the current club
    $sql = 'INSERT INTO user_clubs (user_id, club_id, access_level) VALUES (?, ?, ?)';
    $db->query($sql, $user_id, $club_id, $accessLevel);

    if ($close)
    {
        $db->close();
    }

    return;
}

function removeUserFromClub($user_id, $club_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    // Link the user to the current club
    $sql = 'DELETE FROM user_clubs WHERE user_id = ? AND club_id = ? LIMIT 1';
    $db->query($sql, $user_id, $club_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

?>
