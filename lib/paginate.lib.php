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
function paginate( $smarty, $itemVarName, $mode ){
  require_once('lib/SmartyPaginate.class.php');

  SmartyPaginate::connect();
  SmartyPaginate::setLimit( 25 );

  $smarty->assign( 'items', getPaginatedResults( $itemVarName, 
						 $currentSortIndex,
						 $currentSortDir,
						 $mode ) );
  SmartyPaginate::assign( $smarty );
}


function getPaginatedResults( $itemVarName, $currentSortIndex, $currentSortDir, $mode ){
  switch( $mode )
    {
    case "inventory":
      $items = getInventory( $currentSortindex, $currentSortDir );
      break;
    }
  
  SmartyPaginate::setTotal( count( $items ) );
  return array_slice( $items, SmartyPaginate::getCurrentindex(), 
		      SmartyPaginate::getLimit());
}




?>