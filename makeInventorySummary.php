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
?>