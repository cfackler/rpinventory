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


function getBorrowers($db = null)
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

    // Borrowers
    $query= "SELECT * FROM borrowers WHERE club_id = ?";

    $result = $db->query($query, $club_id);

    $records = $db->getObjectArray($result);

    if ($close)
    {
        $db->close();
    }

    return $records;
}

/* Return the name of the borrower given an id */
function getBorrowerName($id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $id = (int)$id;
    if($id == 0)
        die('ID cannot be zero');

    // Borrowers
    $query = 'SELECT name FROM borrowers WHERE borrower_id = ?';

    $result = $db->query($query, $id);

    $name = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $name->name;
}

function getBorrowerId($name, $club_id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    // Borrowers
    $query= "SELECT borrower_id FROM borrowers WHERE club_id = ? AND name = ?";

    $result = $db->query($query, $club_id, $name);

    $record = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $record->borrower_id;
}

function getBorrowerFromName($name, $db = null)
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
        die('Need club id');
    }

    $club_id = $_SESSION['club'];

    // Borrowers
    $query= "SELECT * FROM borrowers WHERE club_id = ? AND name = ?";

    $result = $db->query($query, $club_id, $name);

    $record = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $record;
}

function getBorrowerNames($name, $db = null)
{
    require_once( 'modules/json/JSON.php' );
    require_once( 'lib/auth.lib.php' );

    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    // Authenticate
    $auth = GetAuthority();
    if($auth < 1)
        die("You dont have permission to access this page");

    if (!isset($_SESSION['club']))
    {
        return array();
    }

    $club_id = $_SESSION['club'];

    $sql = 'SELECT name, club_id FROM borrowers WHERE club_id = ?';

    $result = $db->query($sql, $club_id);

    $names = $db->getObjectArray($result);
    $records = array();

    foreach($names as &$x)
    {
        if (preg_match('/^'.$name.'/i', $x->name))
        {
            $records[] = $x->name;
        }
    }

    $data = array( "records" => $records );

    if ($close)
    {
        $db->close();
    }

    $json = new Services_JSON();

    header('X-JSON: ('.$json->encode( $data ).')');
}

function getViewBorrowers( $currentSortIndex=0, $currentSortDir=0, $db = null)
{
    require_once("lib/auth.lib.php");  //Session

    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    // Authenticate
    $auth = GetAuthority();

    if (!isset($_SESSION['club']))
    {
        return array();
    }

    $club_id = $_SESSION['club'];

    /* Determine query argument for sorting */
    if($currentSortIndex == 0)
        $sortBy = 'name';
    else if($currentSortIndex == 1)
        $sortBy = 'rin';
    else if($currentSortIndex == 2)
        $sortBy = 'email';

    /*  Determine query argument for sort direction
        Ascending is default    */
    if($currentSortDir == 1)
        $sortBy .= ' DESC';


    //users
    $borrowerQuery= "SELECT * from borrowers WHERE club_id = ? ORDER BY ".$sortBy;
    $borrowerResult = $db->query($borrowerQuery, $club_id);

    $borrowers = $db->getObjectArray($borrowerResult);

    if ($close)
    {
        $db->close();
    }

    return $borrowers;
}

function getBorrower($id, $db = null)
{
    require_once('lib/auth.lib.php');

    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    // Authority
    $auth = GetAuthority();

    // Sanitize
    $id = (int)$id;

    $sql = 'SELECT * FROM borrowers WHERE borrower_id = ?';

    $result = $db->query($sql, $id);

    $borrower = $db->getObject($result);

    if ($close)
    {
        $db->close();
    }

    return $borrower;
}

// AJAX Call for adding a new borrower
function insertBorrower( $name, $rin, $email, $address, $address2, $city, $state, $zip, $phone, $db = null)
{
    require_once( 'modules/json/JSON.php' );
    require_once('lib/auth.lib.php');

    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    // Authority
    $auth = GetAuthority();

    $data = Array( "response" => '' );
    $json = new Services_JSON();

    if (!isset($_SESSION['club']))
    {
        return array();
    }

    $club_id = $_SESSION['club'];

    // Duplicate check
    $sql = 'SELECT rin, email FROM borrowers WHERE club_id = ? AND (rin = ? OR email = ?) LIMIT 1';
    $result = $db->query($sql, $club_id, $rin, $email); 

    // Check to make sure a duplicate RIN or email is not given
    if( mysqli_num_rows($result) != 0 ) {
        $obj = $db->getObject($result);

        if( $obj->rin == $rin ) {
            $data['response'] = 'Duplicate RIN entered!';
        }
        else {
            $data['response'] = 'Duplicate email entered!';
        }

        header('X-JSON: ('.$json->encode($data ).')');
        exit();
    }

    $sql = 'INSERT INTO addresses (address_id, address, address2, city, state, zipcode, phone, club_id) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)';

    $result = $db->query($sql, $address, $address2, $city, $state, $zip, $phone, $club_id);

    $address_id = $db->insertId();

    $sql = 'INSERT INTO borrowers (borrower_id, address_id, name, rin, email, club_id) VALUES (NULL, ?, ?, ?, ?, ?)';

    $result = $db->query($sql, $address_id, $name, $rin, $email, $club_id);

    if ($close)
    {
        $db->close();
    }

    header('X-JSON: ('.$json->encode($data).')');
}

// Add a borrower to the system
function addBorrower($addressId, $rin, $email, $name, $db = null)
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

    // Insert the borrower
    $sql = 'INSERT INTO borrowers (borrower_id, address_id, rin, email, name, club_id) VALUES (NULL, ?, ?, ?, ?, ?)';

    $db->query($sql, $addressId, $rin, $email, $name, $club_id);

    $id = $db->insertId();

    if ($close)
    {
        $db->close();
    }

    return $id;
}

function deleteBorrower($borrower_id, $db = null)
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

    $sql = 'DELETE FROM borrowers WHERE borrower_id = ? AND club_id = ?';

    $db->query($sql, $borrower_id, $club_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

function updateBorrower($borrower_id, $name, $rin, $email, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        // Connect
        $db = new database();

        $close = true;
    }

    $sql = 'UPDATE borrowers SET name = ?, rin = ?, email = ? WHERE borrower_id = ?';

    $db->query($sql, $name, $rin, $email, $borrower_id);

    if ($close)
    {
        $db->close();
    }

    return;
}

function VerifyBorrowerExists($id, $db = null)
{
    $close = false;

    if (is_null($db))
    {
        require_once('class/database.class.php');

        $db = new database();

        $close = true;
    }

    //Find borrower
    $result = $db->query('SELECT * FROM borrowers WHERE borrower_id = ?', $id);

    if(mysqli_num_rows($result) == 0)
    {
        $db->close();
        return false;
    }

    if ($close)
    {
        $db->close();
    }

    return true;
}

?>
