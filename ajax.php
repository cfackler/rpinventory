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

switch ($_GET["operation"])
  {
  case "locations":
    print getLocationsOptions();
    break;
  
	case "loanlocations":
		print getLoanLocationsOptions();
		break;

  case "savelocation":
    insertLocation($_GET["location"], $_GET["description"]);
    break;

	case "saveBusiness":
		insertBusiness($_GET["company_name"], $_GET['address'], $_GET['address2'],
									 $_GET['city'], $_GET['state'], $_GET['zipcode'], $_GET['phone'],
									 $_GET['phone_number'], $_GET['fax_number'], $_GET['email'], $_GET['website']);
		break;
    
  case "username":
    print getUsernames( $_GET['name'] );
    break;
  }


?>
