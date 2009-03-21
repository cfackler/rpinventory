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

require_once("lib/connect.lib.php");  // mysql
require_once("lib/auth.lib.php");  // Session

// Authenticate
$auth = GetAuthority();	
if($auth<1)
  die("Please login to complete this action");

$link = connect();
if($link == null)
  die("Database connection failed");

/*if( isset( $_POST['inventory'] ) ){ || !isset( $_POST['loans'] ) ||
    !isset( $_POST['repairs'] ) || !isset( $_POST['purchases'] ) ||
    !isset( $_POST['businesses'] ) || !isset( $_POST['users'] ) ||
    !isset( $_POST['locations'] ) ){
  die( 'Arguments not specified' );
  }*/

/* Get block data */
$inventory = $_POST['inventory'];
$loans = $_POST['loans'];
$repairs = $_POST['repairs'];
$purchases = $_POST['purchases'];
$businesses = $_POST['businesses'];
$users = $_POST['users'];
$locations = $_POST['locations'];

$data = array();

require_once('modules/pdf-php/class.ezpdf.php');
require_once( 'lib/pdf.lib.php' );


$pdf =& new Cezpdf("paper='LETTER'");
  
//choose font
$pdf->selectFont('modules/pdf-php/fonts/Helvetica.afm');

//start page numbers
$pdf->ezStartPageNumbers(300, 50, 10);


if ( isset($inventory) ){
  //add text
  $pdf->ezText('<u>Current Clubname Inventory</u>', 12, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getInventoryData();

  foreach( $return as $item ){
    $data[] = $item;
  }

  $pdf->ezTable( $data );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( isset($loans) ){
  $then = date('Y-m-d', time() - (60*60*24*30*6));
  $now = date('Y-m-d', time());

  //add text
  $pdf->ezText('<u>Clubname Loan History</u>', 12, array('justification'=>'center'));
  $pdf->ezText('<u>'. $then .' to '. $now .'</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getLoanData( $then, $now );
  
  foreach( $return as $item ){
    $data[] = $item;
  }

  $pdf->ezTable( $data );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( isset($repairs) ){
  $then = date('Y-m-d', time() - (60*60*24*30*6));
  $now = date('Y-m-d', time());

  //add text
  $pdf->ezText('<u>Clubname Repair History</u>', 12, array('justification'=>'center'));
  $pdf->ezText('<u>'. $then .' to '. $now .'</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');

  $return = getRepairData();
  
  foreach( $return as $item ){
    $data[] = $item;
  }

  $pdf->ezTable( $data );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( isset($purchases) ){
  $then = date('Y-m-d', time() - (60*60*24*30*6));
  $now = date('Y-m-d', time());

  //add text
  $pdf->ezText('<u>Clubname Purchase History</u>', 12, array('justification'=>'center'));
  $pdf->ezText('<u>'. $then .' to '. $now .'</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');

  $return = getPurchasesData();
  
  foreach( $return as $item ){
    $data[] = $item;
  }

  $pdf->ezTable( $data );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( isset($businesses) ){
  //add text
  $pdf->ezText('<u>Clubname Businesses</u>', 12, array('justification'=>'center'));
  $pdf->ezText('');
  
  $return = getBusinessesData();
  
  foreach( $return as $item ){
    $data[] = $item;
  }

  $pdf->ezTable( $data );
  unset($data);
  $data= array();
  $pdf->ezText('');
}

if ( isset($users) ){
  //add text
  $pdf->ezText('<u>Current Clubname Users</u>', 12, array('justification'=>'center'));
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

if ( isset($locations) ){
  //add text
  $pdf->ezText('<u>Clubname Locations</u>', 12, array('justification'=>'center'));
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