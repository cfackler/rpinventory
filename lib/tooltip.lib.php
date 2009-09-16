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

function getToolTips($page) {
	$html = array();
	$html['helpDiv'] = '<div id="helpToolTip" style="border: thin solid black;"></div>';	// Where the message is displayed

	switch($page) {
		case "addPurchase":
			$html['ignoreBusiness'] = generate( 'ignoreBusinessHelp', 'Check this option if you do not want to keep track of the purchase information for this item, and want to just enter an item into the inventory.' );
			break;

		case 'loanItem':
			$html['loanTo'] = generate( 'loanToHelp', 'Begin to type the name of the user to loan to, and, if the user already exists, an autocompletion menu will appear');
			$html['newBorrower'] = generate( 'newBorrowerHelp', 'Check this box, and then enter the required information to create the user');
			break;
    
        case 'checkoutItem':
			$html['checkoutTo'] = generate( 'checkoutToHelp', 'Begin to type the name of the user to checkout to, and, if the user already exists, an autocompletion menu will appear');
			$html['newBorrower'] = generate( 'newBorrowerHelp', 'Check this box, and then enter the required information to create the user');
			break;

	}

	return $html;
}

function generate( $id, $message ) {
	return '<img id="'. $id .'" onMouseOver="showToolTip(\''. $id .'\', \''. $message .'\')" onMouseOut="hideToolTip()" src="images/questionmark.png" alt="Help" />';
}




?>
