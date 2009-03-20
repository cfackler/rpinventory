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


require_once('modules/pdf-php/class.ezpdf.php');
require_once('lib/inventory.lib.php');
require_once('lib/loans.lib.php');

function generatePDF(){
  

function getInventoryPDF()
{
	$items = getInventory();
	
	//create new pdf document
	$pdf =& new Cezpdf("paper='LETTER'");
	
	//choose font
	$pdf->selectFont('modules/pdf-php/fonts/Helvetica.afm');
	
	//start page numbers
	$pdf->ezStartPageNumbers(300, 50, 10);
	
	//add text
	$pdf->ezText('<u>Current Clubname Inventory</u>', 12, array('justification'=>'center'));
	$pdf->ezText('');
	
	$data = array();
	foreach($items as $value)
	{
		$data [] = array('Item'=>$value->description,
						'Condition'=>$value->current_condition,
						'Value'=>$value->current_value,
						'Location'=>$value->location);
	}
	$pdf->ezTable($data);
	
	
	//output document
	$pdf->ezStream();

}

function getLoanPDF()
{
  $then = date('Y-m-d', time() - (60*60*24*30*6));
  $now = date('Y-m-d', time());

  $records = getLoans( $then, $now );
  
  //create new pdf document
  $pdf =& new Cezpdf("paper='LETTER'");
  
  //choose font
  $pdf->selectFont('modules/pdf-php/fonts/Helvetica.afm');
  
  //start page numbers
  $pdf->ezStartPageNumbers(300, 50, 10);
  
  //add text
  $pdf->ezText('<u>Clubname Borrowing History</u>', 12, array('justification'=>'center'));
  $pdf->ezText('<u>'. $then .' to '. $now .'</u>', 10, array('justification'=>'center'));
  $pdf->ezText('');
  
  $data = array();
  foreach($records as $value)
    {
      /*     echo "'";
      print_r( $value->return_date);
      echo "'";
      echo "<br/>";*/
      if( $value->return_date == '' ){ /* Not yet returned */
	$value->return_date = "Outstanding";
      }

      $data [] = array('Item' => $value->description,
		       'Condition' => $value->starting_condition,
		       'User' => $value->username,
		       'Date Issued' => $value->issue_date,
		       'Date Returned' => $value->return_date);
    }
  
  $pdf->ezTable($data);
  
  //output document
  $pdf->ezStream();
  
}
?>