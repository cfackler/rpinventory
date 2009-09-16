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



function getInventoryData()
{
  require_once( 'lib/inventory.lib.php' );
  $items = getInventory();
  
  $data = array();
  foreach($items as $value)
    {
      $data [] = array('Item' => $value->description,
		       'Condition' => $value->current_condition,
		       'Value' => '$'.$value->current_value,
		       'Location' => $value->location);
    }
  
  return $data;
}

function getLoanData( $startDate, $endDate )
{
  require_once( 'lib/loans.lib.php' );

  $records = getLoans( $startDate, $endDate );

  $data = array();
  foreach( $records as $value ) {
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
  require_once( 'lib/repairs.lib.php' );

  $records = getRepairs( $startDate, $endDate );

  $data = array();
  foreach( $records as $value ) {
    $data[] = array('Item' => $value->inventory_description,
		    'Repairer' => $value->company_name,
		    'Repair Date' => $value->repair_date,
		    'Repair Description' => $value->repair_description,
		    'Repair Cost' => '$'.$value->repair_cost);

  }

  return $data;
}

function getCheckoutData( $startDate, $endDate ){
  require_once( 'lib/checkouts.lib.php' );
  
  $records = getCheckouts( $startDate, $endDate );
  
  $data = array();
  foreach( $records as $value ) {
    if( $value->return_date == '' ){
      $value->return_date = "Outstanding";
    }

    $data[] = array('Item' => $value->description,
		    'Starting Condition' => $value->starting_condition,
		    'Ending Condition' => $value->ending_condition,
		    'Event Used' => $value->event_name,
		    'User' => $value->username,
		    'Time Issued' => $value->time_taken,
		    'Time Returned' => $value->time_returned );
  }

  return $data;
}

function getPurchasesData( $startDate, $endDate )
{
  require_once( 'lib/purchases.lib.php' );

  $data = array();

  $records = getPurchases( $startDate, $endDate );
  foreach( $records as $value ) {
    $data[] = array('Item' => $value->description,
		    'Company' => $value->company_name,
		    'Cost' => '$'.$value->cost,
		    'Purchase Date' => $value->purchase_date,
		    'Purchase Order ID' => $value->purchase_id);
  }

  return $data;
}


function getBusinessesData()
{
  require_once( 'lib/businesses.lib.php' );

  $data1 = array();
  $data2 = array();

  $records = getBusinesses();
  foreach( $records as $value ) {
    $data1[] = array('Company Name' => $value->company_name,
		     'Address' => $value->address,
		     'Address2' => $value->address2,
		     'City' => $value->city,
		     'State' => $value->state,
		     'Zipcode' => $value->zipcode,
		     'Phone' => $value->phone,
		     'Fax' => $value->fax,);
  }
  foreach( $records as $value ) {
    $data2[] = array('Company Name' => $value->company_name,
		     'Email' => $value->email,
		     'Website' => $value->website);
  }

  return array($data1, $data2);
}


function getUsersData()
{
  require_once( 'lib/users.lib.php' );

  $data = array();

  $records = getUsers();
  foreach( $records as $value ) {
    $data[] = array('Name' => $value->name,
		     'Username' => $value->username,
		     'RIN' => $value->rin,
		     'Email Address' => $value->email);
  }

  return $data;
}


function getLocationsData()
{
  require_once( 'lib/locations.lib.php' );

  $data = array();

  $records = getLocations();
  foreach( $records as $value ) {
    $data[] = array('Location' => $value->location,
		     'Description' => $value->description);
  }

  return $data;
}

function getInventorySummary(){
  require_once( "lib/connect.lib.php" );  // mysql
  require_once( "lib/auth.lib.php" );  // Session
  
  // Authenticate
  $auth = GetAuthority();	
  
  $link = connect();
  if($link == null)
    die("Database connection failed");
  
  require_once( 'lib/config.class.php' );
  
  $data = array();
  $clubName = Config::get( 'club_name' );
  
  require_once('modules/pdf-php/class.ezpdf.php');
  require_once( 'lib/pdf.lib.php' );
  
  
  $pdf =& new Cezpdf('LETTER', 'landscape');
  
  //choose font
  $pdf->selectFont('modules/pdf-php/fonts/Helvetica.afm');
  
  //start page numbers
  $pdf->ezStartPageNumbers(300, 50, 10);
  $pdf->ezText('<u>'.$clubName.'</u>', 14, array('justification'=>'center') );
  $pdf->ezText('');
  
  
  //add inventory table
  $pdf->ezText('<u>Current Inventory</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');

  $return = getInventoryData();
  
  $pdf->ezTable( $return );
  unset($data);
  $data= array();
  $pdf->ezText('');
  
  $pdf->ezStream();
}

?>