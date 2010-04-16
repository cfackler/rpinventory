<?php
/*

  Copyright (C) 2010, All Rights Reserved.

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

function getLocation($location_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

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

    if ($close)
    {
        // Close connection
        $db->close();
    }

    return $location;

}

function getLocations($db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

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

    if ($close)
    {
        // Close connection
        $db->close();
    }

    return $locations;
}

/* Gets the most commonly used location. Returns false upon failure */
function getCommonLocation($db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'SELECT count(locations.location_id) AS counts, locations.location_id, location FROM inventory, locations
        WHERE locations.location_id = inventory.location_id GROUP BY locations.location_id ORDER BY counts desc LIMIT 1';

    $result = $db->query($sql);

    $location = $db->getObject($result);

    if( $location->location_id == NULL ) {
        return false;
    }

    if ($close)
    {
        // Close connection
        $db->close();
    }

    return $location;
}

/* Gets the "On Loan" location*/
function getOnLoanLocation($db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'SELECT * FROM locations WHERE location = "On Loan"';

    $result = $db->query($sql);

    $result = $db->getObject($result); 

    if ($close)
    {
        // Close connection
        $db->close();
    }

    return $result;
}

/* Gets the html for the location select object */
function getLocationsOptions($db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $loc_select;

    //get locations array
    $locations = getLocations($db);

    /* Gets the most common location_id */
    $commonLocation = getCommonLocation($db);

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

    if ($close)
    {
        // Close connection
        $db->close();
    }

    return $loc_select;
}

/* Same as getLocationsOptions except places 'On Loan' as the first entry */
function getLoanLocationsOptions($db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $loc_select;

    //get locations array
    $locations = getLocations($db);

    /* Gets the item to put first in the list: the "On Loan" location */
    $firstLocation = getOnLoanLocation($db);

    $loc_select = '<option value="'.$firstLocation->location_id . '">';
    $loc_select .= $firstLocation->location . '</option>';

    foreach($locations as $location) {
        if( $location->location_id != $commonLocation->location_id && $location->location != 'On Loan'){
            $loc_select .= '<option value="' . $location->location_id . '">';
            $loc_select .= $location->location . '</option>';
        }
    }
    $loc_select .= '<option>New Location</option>';

    if ($close)
    {
        // Close connection
        $db->close();
    }

    return $loc_select;
}

// AJAX version of inserting a location
function insertLocation($location, $desc, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $club_id = (int)$_SESSION['club'];

    if ($club_id < 1)
    {
        die('Invalid club id');
    }

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

    $sql = 'INSERT INTO locations (location_id, location, description, club_id) VALUES (NULL, ?, ?, ?)';

    $db->query($sql, $location, $desc, $club_id);

    if ($close)
    {
        // Close connection
        $db->close();
    }

    return 'success';
}

// Add a new location
function addLocation($location, $description, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $club_id = (int)$_SESSION['club'];

    if ($club_id < 1)
    {
        die('Invalid club id');
    }

    $sql = 'INSERT INTO locations (location_id, location, description, club_id) VALUES (NULL, ?, ?, ?)';

    $db->query($sql, $location, $description, $club_id);

    $id = $db->insertId();

    if ($close)
    {
        // Close connection
        $db->close();
    }

    return $id;
}

function deleteLocation($location_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'DELETE FROM locations WHERE location_id = ?';

    $db->query($sql, $location_id);

    if ($close)
    {
        // Close connection
        $db->close();
    }

    return;
}

function getViewLocations( $currentSortIndex=0, $currentSortDir=0, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

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

    $locations = $db->getObjectArray($locResult);

    if ($close)
    {
        // Close connection
        $db->close();
    }

    return $locations;
}

function updateLocation($location_id, $location, $description, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'UPDATE locations SET description = ?, location = ? WHERE location_id = ?';

    $db->query($sql, $description, $location, $location_id);

    if ($close)
    {
        // Close connection
        $db->close();
    }

    return;
}

?>
