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

require_once( "lib/connect.lib.php" );  // mysql
require_once( "lib/auth.lib.php" );  // Session

// Authenticate
$auth = GetAuthority();	
if($auth<1)
  die("Please login to complete this action");

$link = connect();
if($link == null)
  die("Database connection failed");

if ( !isset( $_POST['startdate'] ) || !isset( $_POST['enddate'] ) ){
  die( "Start or end date not specified" );
}

/* Get block data */
$inventory = mysqli_real_escape_string( $link, $_POST['inventory'] );
$loans = mysqli_real_escape_string( $link, $_POST['loans'] );
$checkouts = mysqli_real_escape_string( $link, $_POST['checkouts'] );
$repairs = mysqli_real_escape_string( $link, $_POST['repairs'] );
$purchases = mysqli_real_escape_string( $link, $_POST['purchases'] );
$businesses = mysqli_real_escape_string( $link, $_POST['businesses'] );
$users = mysqli_real_escape_string( $link, $_POST['users'] );
$locations = mysqli_real_escape_string( $link, $_POST['locations'] );

$startDate = mysqli_real_escape_string( $link, $_POST['startdate'] );
$endDate = mysqli_real_escape_string( $link, $_POST['enddate'] );

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
$pdf->ezText('<u>'. $startDate .' to '. $endDate .'</u>', 12, array('justification'=>'center'));
$pdf->ezText('');


if ( $inventory != '' ){
  //add text
  $pdf->ezText('<u>Current Inventory</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getInventoryData();

  $pdf->ezTable( $return );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( $loans != '' ){
  //add text
  $pdf->ezText('<u>Loan History</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getLoanData( $startDate, $endDate );

  $pdf->ezTable( $return );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( $checkouts != '' ){
  $pdf->ezText('<u>Checkout History</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');

  $return = getCheckoutData( $startDate, $endDate );

  $pdf->ezTable( $return );
  unset( $data );
  $data = array();
  $pdf->ezText('');
}

if ( $repairs != '' ){
  //add text
  $pdf->ezText('<u>Repair History</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');

  $return = getRepairData( $startDate, $endDate );

  $pdf->ezTable( $return );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( $purchases != '' ){
  //add text
  $pdf->ezText('<u>Purchase History</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');

  $return = getPurchasesData( $startDate, $endDate );

  $pdf->ezTable( $return );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( $businesses != '' ){
  //add text
  $pdf->ezText('<u>Businesses</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getBusinessesData();
  
  foreach( $return as $item ){
    $data[] = $item;
  }

  $pdf->ezTable( $return[0] );
  $pdf->ezText('');
  $pdf->ezTable( $return[1] );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( $users != '' ){
  //add text
  $pdf->ezText('<u>Users</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getUsersData();
  
  foreach( $return as $item ){
    $data[] = $item;
  }

  $pdf->ezTable( $data );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( $locations != '' ){
  //add text
  $pdf->ezText('<u>Locations</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getLocationsData();
  
  foreach( $return as $item ){
    $data[] = $item;
  }

  $pdf->ezTable( $data );
  unset($data);
  $data= array();
  $pdf->ezText('');
}


$pdf->ezStream();
?>