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

//inventory.lib.php
require_once("lib/connect.lib.php");  //mysql
require_once("lib/auth.lib.php");  //Session

/* Takes two dates, formatted as YYYY-MM-DD */
function getLoans($startDate, $endDate)
{
  // Connect
  $link = connect();
  if( $link == null )
    die( "Database connection failed" );
  
  // Authenticate
  $auth = GetAuthority();

  $startDate = mysqli_real_escape_string( $link, $startDate );
  $endDate = mysqli_real_escape_string( $link, $endDate);
  
  // Loan History
  $query= "SELECT issue_date, return_date, starting_condition, inventory.description, username FROM loans, inventory, logins WHERE logins.id = loans.borrower_id AND loans.inventory_id = inventory.inventory_id AND issue_date >= '". $startDate ."' AND (return_date <= '". $endDate ."' OR return_date IS NULL)";

  $result = mysqli_query($link, $query) or
    die( 'Could not get the loan history' );

  $records = array();
  
  while($record = mysqli_fetch_object($result))
    {
      $records [] = $record;
    }
  
  mysqli_close($link);	
  
  return $records;
}

?>