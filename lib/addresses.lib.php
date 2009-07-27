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

/* Returns the id of the given borrower */
function getAddressFromBorrower( $id ) {
	require_once('lib/connect.lib.php');
	require_once('lib/auth.lib.php');

	// Database
	$link = connect();
	if( $link == null )
		die( 'Database connection failed' );

	// Authority
	$auth = GetAuthority();

	// Sanitize
	$id = (int)$id;
	if($id == 0)
		die('Invalid ID');

	$sql = 'SELECT address_id FROM borrower_addresses WHERE user_id = ' . $id;

	$result = mysqli_query($link, $sql) or
		die( 'Query Failed' );

	$address_id = mysqli_fetch_object($result);

	return $address_id->address_id;
}

/* Returns the address with the given id */
function getAddress( $id ) {
	require_once('lib/connect.lib.php');
	require_once('lib/auth.lib.php');

	// Database
	$link = connect();
	if( $link == null )
		die( 'Database connection failed' );

	// Authority
	$auth = GetAuthority();

	// Sanitize
	$id = (int)$id;
	if($id == 0)
		die('Invalid ID');

	$sql = 'SELECT * FROM addresses WHERE address_id = ' . $id;

	$result = mysqli_query($link, $sql) or
		die( 'Query failed' );

	$address = mysqli_fetch_object($result);

	return $address;
}

?>
