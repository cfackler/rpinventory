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



function getInventoryData()
{
  require_once('lib/inventory.lib.php');
  $items = getInventory();
  
  $data = array();
  foreach($items as $value)
    {
      $data [] = array('Item'=>$value->description,
		       'Condition'=>$value->current_condition,
		       'Value'=>'$'.$value->current_value,
		       'Location'=>$value->location);
    }
  
  return $data;
}

function getLoanData( $startDate, $endDate )
{
  require_once('lib/loans.lib.php');

  $records = getLoans( $startDate, $endDate );

  $data = array();
  foreach($records as $value)
    {
      if( $value->return_date == '' ){ /* Not yet returned */
	$value->return_date = "Outstanding";
      }

      $data [] = array('Item' => $value->description,
		       'Condition' => $value->starting_condition,
		       'User' => $value->username,
		       'Date Issued' => $value->issue_date,
		       'Date Returned' => $value->return_date);
    }

  return $data;
}

function getRepairData( $startDate, $endDate )
{
  $data = array();

  return $data;
}

function getPurchasesData( $startDate, $endDate )
{
  $data = array();

  return $data;
}


function getBusinessesData()
{
  $data = array();

  return $data;
}


function getUsersData()
{
  $data = array();

  return $data;
}


function getLocationsData()
{
  $data = array();

  return $data;
}
?>