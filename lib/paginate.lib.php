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

/* Takes the smarty variable and the name of the variable storing 
   the information to be displayed */
function paginate( $smarty, $itemVarName, $currentSortIndex, $currentSortDir, $mode ){
  require_once('lib/SmartyPaginate.class.php');

  SmartyPaginate::disconnect();	/* Remove the old session data first, or URL's are wrong */
  SmartyPaginate::connect();
  SmartyPaginate::setLimit( 15 );

  $smarty->assign( $itemVarName, getPaginatedResults( $smarty,
						      $itemVarName, 
						      $currentSortIndex,
						      $currentSortDir,
						      $mode ) );
  SmartyPaginate::assign( $smarty );
}


function getPaginatedResults( $smarty, $itemVarName, $currentSortIndex, $currentSortDir, $mode ){
  if( isset( $_GET['sort'] ) ){	/* Save the sorting direction if it exists */
    $_SESSION['SmartyPaginate']['default']['url'] .= '?sort=' . $_GET['sort'];

    if( isset( $_GET['sortdir'] ) ){
      $_SESSION['SmartyPaginate']['default']['url'] .= '&sortdir=' . $_GET['sortdir'];
    }
  }

  switch( $mode )
    {
    case 'inventory':
      $items = getInventory( $currentSortIndex, $currentSortDir );
       break;
      
    case 'borrowers':
      $items = getBorrowers( $currentSortIndex, $currentSortDir );
      break;
    
    case 'loans':
      $items = getViewLoans( $currentSortIndex, $currentSortDir );

      if( isset( $_GET['sort'] ) ){ /* Form correct GET request */
	$_SESSION['SmartyPaginate']['defualt']['url'] .= '&';
      }
      else{
	$_SESSION['SmartyPaginate']['default']['url'] .= '?';
      }

      if( isset( $_GET['view'] ) ){ /* Save the view we're currently on */
	$_SESSION['SmartyPaginate']['default']['url'] .= 'view=' . $_GET['view'];
      }
      break;

    case 'checkouts':
      $items = getViewCheckouts( $currentSortIndex, $currentSortDir );

      if( isset( $_GET['sort'] ) ){ /* Form correct GET request */
	$_SESSION['SmartyPaginate']['defualt']['url'] .= '&';
      }
      else{
	$_SESSION['SmartyPaginate']['default']['url'] .= '?';
      }

      if( isset( $_GET['view'] ) ){ /* Save the view we're currently on */
	$_SESSION['SmartyPaginate']['default']['url'] .= 'view=' . $_GET['view'];
      }
      break;

    case 'repairs':
      $items = getViewRepairs( $currentSortIndex, $currentSortDir );
      break;

    case 'purchases':
      $items = getViewPurchases( $currentSortIndex, $currentSortDir );
      break;

    case 'businesses':
      $items = getViewBusinesses( $currentSortIndex, $currentSortDir );
      break;

    case 'locations':
      $items = getViewLocations( $currentSortIndex, $currentSortDir );
      break;
    }
  

  
  SmartyPaginate::setTotal( count( $items ) );
  $smarty->assign('displayPaginate', SmartyPaginate::getLimit() < SmartyPaginate::getTotal() );
  return array_slice( $items, SmartyPaginate::getCurrentindex(), 
		      SmartyPaginate::getLimit());
}




?>