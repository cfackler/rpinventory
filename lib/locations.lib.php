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

function getLocation($location_id)
{
    require_once('class/database.class.php');

    // Connect
    $db = new database();

    if (!isset($_SESSION['club']))
    {
        return NULL;
    }

    $club_id = $_SESSION['club'];

    $sql = 'SELECT * FROM locations WHERE club_id = ? AND location_id = ?';

    // Execute query
    $result = $db->query($sql, $club_id, $location_id);

    // Get array of objects
    $location = $db->getObject($result);

    // Close connection
    $db->close();

    return $location;

}

function getLocations()
{
    require_once('class/database.class.php');

    // Connect
    $db = new database();

    if (!isset($_SESSION['club']))
    {
        return array();
    }

    $club_id = $_SESSION['club'];

    // Loan History
    $sql = 'SELECT location_id, location, description, club_id FROM locations WHERE club_id = ?';

    // Execute query
    $result = $db->query($sql, $club_id);

    // Get array of objects
    $locations = $db->getObjectArray($result);

    // Close connection
    $db->close();

    return $locations;
}

/* Gets the most commonly used location. Returns false upon failure */
function getCommonLocation()
{
    require_once('class/database.class.php');
    require_once( 'lib/auth.lib.php' );

    // Connect
    $db = new database();

    // Authenticate
    $auth = GetAuthority();
    if($auth < 1)
        die('You dont have permission to access this page');

    $sql = 'SELECT count(locations.location_id) AS counts, locations.location_id, location FROM inventory, locations
        WHERE locations.location_id = inventory.location_id GROUP BY locations.location_id ORDER BY counts desc LIMIT 1';

    $result = $db->query($sql);

    $location = $db->getObject($result);

    if( $location->location_id == NULL ) {
        return false;
    }

    return $location;
}

/* Gets the "On Loan" location*/
function getOnLoanLocation()
{
    require_once('class/database.class.php');    
    require_once( 'lib/auth.lib.php' );

    // Connect
    $db = new database();

    // Authenticate
    $auth = GetAuthority();
    if( $auth < 1 )
        die( 'You don\'t have permission to access this page' );

    $sql = 'SELECT * FROM locations WHERE location = "On Loan"';

    $result = $db->query($sql);

    $result = $db->getObject($result); 

    $db->close();

    return $result;
}

/* Gets the html for the location select object */
function getLocationsOptions()
{
    $loc_select;

    //get locations array
    $locations = getLocations();

    /* Gets the most common location_id */
    $commonLocation = getCommonLocation();

    /* Make sure we found a common location */
    if( $commonLocation ) {
        $loc_select = '<option value="'.$commonLocation->location_id . '">';
        $loc_select .= stripslashes($commonLocation->location) . '</option>';
    }

    foreach($locations as $location) {
        if( $location->location_id != $commonLocation->location_id && $location->location != 'On Loan'){
            $loc_select .= '<option value="' . $location->location_id . '">';
            $loc_select .= stripslashes($location->location) . '</option>';
        }
    }

    return $loc_select;
}

/* Same as getLocationsOptions except places 'On Loan' as the first entry */
function getLoanLocationsOptions()
{
    $loc_select;

    //get locations array
    $locations = getLocations();

    /* Gets the item to put first in the list: the "On Loan" location */
    $firstLocation = getOnLoanLocation();

    $loc_select = '<option value="'.$firstLocation->location_id . '">';
    $loc_select .= $firstLocation->location . '</option>';

    foreach($locations as $location) {
        if( $location->location_id != $commonLocation->location_id && $location->location != 'On Loan'){
            $loc_select .= '<option value="' . $location->location_id . '">';
            $loc_select .= $location->location . '</option>';
        }
    }
    $loc_select .= '<option>New Location</option>';

    return $loc_select;
}

// AJAX version of inserting a location
function insertLocation($location, $desc)
{
    require_once('class/database.class.php');
    require_once('lib/auth.lib.php');  //Session

    // Authenticate
    $auth = GetAuthority();	
    if($auth<1)
        die('Please login to complete this action');

    $db = new database();

    // Description
    if(strlen($desc) == 0)
        die('Must have a description');

    // Location
    if(strlen($location) == 0)
        die('Must have a location');

    $location = trim($location);

    $sql = "SELECT location FROM locations";

    $result = $db->query($sql);

    $locations = $db->getObjectArray($result);

    foreach($locations as &$loc)
    {
        if (strcasecmp($loc->location, $location) == 0)
        {
            die('A location already exists with name, "' . $location .'"');
        }
    }

    $sql = 'INSERT INTO locations (location_id, location, description) VALUES (NULL, ?, ?)';

    $db->query($sql, $location, $desc);

    $db->close();

    return 'success';

}

// Add a new location
function addLocation($location, $description)
{
    require_once('class/database.class.php');

    $db = new database();

    $sql = 'INSERT INTO locations (location_id, location, description) VALUES (NULL, ?, ?)';

    $db->query($sql, $location, $description);

    $id = $db->insertId();

    $db->close();

    return $id;
}

function deleteLocation($location_id)
{
    require_once('class/database.class.php');

    $db = new database();

    $sql = 'DELETE FROM locations WHERE location_id = ?';

    $db->query($sql, $location_id);

    $db->close();

    return;
}

function getViewLocations( $currentSortIndex=0, $currentSortDir=0 ) {
    require_once('class/database.class.php');
    require_once('lib/auth.lib.php');  //Session

    $db = new database();

    //Authenticate
    $auth = GetAuthority();

    /* Determine query argument for sorting */
    if($currentSortIndex == 0)
        $sortBy = 'location';
    else if($currentSortIndex == 1)
        $sortBy = 'description';

    /*  Determine query argument for sort direction
    Ascending is default    */
    if($currentSortDir == 1)
        $sortBy .= ' DESC';

    //users
    $locQuery= 'SELECT * from locations ORDER BY '.$sortBy;
    $locResult = $db->query($locQuery);

    $location = $db->getObjectArray($locResult);

    $db->close();

    return $locations;
}

function updateLocation($location_id, $location, $description)
{
    require_once('class/database.class.php');

    $db = new database();

    $sql = 'UPDATE locations SET description = ?, location = ? WHERE location_id = ?';

    $db->query($sql, $description, $location, $location_id);

    $db->close();

    return;
}

?>
