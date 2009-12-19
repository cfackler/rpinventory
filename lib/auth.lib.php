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

function Authenticate($username, $password, $clubID, $link)
{

  $safeUsername = mysqli_real_escape_string($link, $username);
  $md5Password = md5($password);
	
  //Find user
  $result=mysqli_query($link, "SELECT l.id, uc.access_level, clubs.club_name FROM logins l, user_clubs uc, clubs WHERE l.id=uc.user_id AND uc.club_id=" . $clubID . " AND l.username='" . $safeUsername . "' AND l.password='" . $md5Password . "' AND uc.club_id=clubs.club_id");

  //verify count
  if(mysqli_num_rows($result) == 0)
    return false;

  $row = mysqli_fetch_object($result);
	
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

function VerifyUserExists($id, $link)
{
	
  //Find user
  $result=mysqli_query($link, "select * from logins where id=" . mysqli_real_escape_string($link, $id));

  //verify count
  if(mysqli_num_rows($result) == 0)
    return false;

  return true;
}

function VerifyBorrowerExists($id, $link)
{
  //Find borrower
  $result = mysqli_query($link, 'SELECT * FROM borrowers WHERE borrower_id = ' . mysqli_real_escape_string($link,$id)) or
    die("Query Failed: ".mysqli_error($link));

  if(mysqli_num_rows($result) == 0)
    return false;

  return true;
}

function VerifyBusinessExists($id, $db)
{
    //Find business
    $result = $db->query('SELECT * FROM businesses WHERE business_id= ?', $id);

    //verify count
    if (mysqli_num_rows($result) == 0)
    {
        return false;
    }

    return true;
}

function VerifyItemExists($id, $link)
{
  //Find Inventory Item
  $result=mysqli_query($link, "select * from `inventory` where inventory_id=" . $id);

  //verify count
  if(mysqli_num_rows($result) == 0)
    return false;

  return true;
}

?>
