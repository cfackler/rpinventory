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

require_once( "lib/auth.lib.php" );  // Session
require_once('class/database.class.php');

// Connect
$db = new database();

// Authenticate
$auth = GetAuthority();	
if($auth<1)
  die("Please login to complete this action");

if (!isset( $_POST['start_Month'] ) || 
    !isset( $_POST['start_Day'] ) ||
    !isset( $_POST['start_Year'] ) ||
    !isset( $_POST['end_Month'] ) ||
    !isset( $_POST['end_Day'] ) ||
    !isset( $_POST['end_Year'] ) ){
  die( "Start or end date not specified" );
}

/* Get block data */
$inventory = $_POST['inventory'];
$loans = $_POST['loans'];
$checkouts = $_POST['checkouts'];
$repairs = $_POST['repairs'];
$purchases = $_POST['purchases'];
$businesses = $_POST['businesses'];
$users = $_POST['users'];
$borrowers = $_POST['borrowers'];
$locations = $_POST['locations'];
$startDate = $_POST['start_Year'] . '-' . $_POST['start_Month'] . '-' . $_POST['start_Day'];
$endDate = $_POST['end_Year'] . '-' . $_POST['end_Month'] . '-' . $_POST['end_Day'];

require_once( 'class/config.class.php' );

$data = array();
$clubName = Config::get( 'club_name' );

require_once('modules/pdf-php/class.ezpdf.php');
require_once( 'lib/pdf.lib.php' );


$pdf =& new Cezpdf('LETTER', 'landscape');
  
//choose font
$pdf->selectFont('modules/pdf-php/fonts/Helvetica.afm');

//start page numbers
$pdf->ezStartPageNumbers(410, 10, 10);
$pdf->ezText('<u>'.$clubName.'</u>', 14, array('justification'=>'center') );
$pdf->ezText('<u>'. $startDate .' to '. $endDate .'</u>', 12, array('justification'=>'center'));
$pdf->ezText('');


if ( $inventory != '' ){
  //add text
  $pdf->ezText('<u>Current Inventory</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getInventoryData($db);

  $pdf->ezTable( $return );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( $loans != '' ){
  //add text
  $pdf->ezText('<u>Loan History</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getLoanData($startDate, $endDate, $db);

  $pdf->ezTable( $return );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( $checkouts != '' ){
  $pdf->ezText('<u>Checkout History</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');

  $return = getCheckoutData($startDate, $endDate, $db);

  $pdf->ezTable( $return );
  unset( $data );
  $data = array();
  $pdf->ezText('');
}

if ( $repairs != '' ){
  //add text
  $pdf->ezText('<u>Repair History</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');

  $return = getRepairData($startDate, $endDate, $db);

  $pdf->ezTable( $return );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( $purchases != '' ){
  //add text
  $pdf->ezText('<u>Purchase History</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');

  $return = getPurchasesData($startDate, $endDate, $db);

  $pdf->ezTable( $return );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( $businesses != '' ){
  //add text
  $pdf->ezText('<u>Businesses</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getBusinessesData($db);
  
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

if ( $borrowers != '' ){
  //add text
  $pdf->ezText('<u>Borrowers</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getBorrowerData($db);
  
  foreach( $return as $item ){
    $data[] = $item;
  }

  $pdf->ezTable( $data );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( $users != '' ){
  //add text
  $pdf->ezText('<u>Users</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getUsersData($db);
  
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
  
  $return = getLocationsData($db);
  
  foreach( $return as $item ){
    $data[] = $item;
  }

  $pdf->ezTable( $data );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

$db->close();

$pdf->ezStream();
?>
