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

require_once( 'lib/locations.lib.php' );
require_once( 'lib/users.lib.php' );
require_once( 'lib/businesses.lib.php' );
require_once( 'lib/borrowers.lib.php' );
require_once( 'lib/display.lib.php' );
require_once( 'lib/categories.lib.php' );

switch ($_GET['operation'])
  {
  case 'locations':
    print getLocationsOptions();
    break;
	
	case 'businesses':
			print getBusinessesOptions();
			break;
  
	case 'loanlocations':
		print getLoanLocationsOptions();
		break;

  case 'savelocation':
    print insertLocation($_GET['location'], $_GET['description']);
    break;

	case 'saveBusiness':
		print insertBusiness($_POST['company_name'], $_POST['address'], $_POST['address2'],
									 $_POST['city'], $_POST['state'], $_POST['zipcode'], $_POST['phone'],
									 $_POST['fax_number'], $_POST['email'], $_POST['website']);
		break;

	case 'saveBorrower':
		insertBorrower($_GET['borrower_name'], $_GET['rin'], $_GET['email'],
									 $_GET['address'], $_GET['address2'], $_GET['city'],
									 $_GET['state'], $_GET['zipcode'], $_GET['phone']);
		break;		
    
  case 'username':
    print getUsernames( $_GET['name'] );
    break;

	case 'borrowerNames':
		print getBorrowerNames( $_GET['name'] );
		break;
		
	case 'insertCategory':
		print insertCategory($_GET['category_name']);
		break;
	
	case 'options':
		print get_options($_GET['table_name'], $_GET['value_column'], $_GET['display_column']);
		break;
		
	case 'itemCategoryIDs':
		if(isset($_POST['store']))
			print get_item_category_ids($_POST['inventory_id'], $_POST['store']);
		else
			print get_item_category_ids($_POST['inventory_id']);
		break;
	}


?>
