<?php

/**
 *	get_options is used for formatting the <option>s of a <select> box.
 *
 *	@param		$tableName			is the table from which to retrieve the values.
 *	@param		$valueColumn		value that will be <option value="here"> for each <option>
 *	@param		$displayColumn	value that will be <option>displayed here</option>
 *
 *	@return 	formatted list of <option> tags.
 **/
function get_options($tableName, $valueColumn, $displayColumn, $db = null)
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
        return '';
    }

    $club_id = $_SESSION['club'];

    $query = 'SELECT '.$valueColumn.', '.$displayColumn.' FROM '.$tableName.' WHERE club_id = ?';
    $result = $db->query($query, $club_id);

    $options = '';
    while($item = $db->getObject($result))
    {
        $options .= '<option value="'.$item->$valueColumn.'">'.$item->$displayColumn.'</option>';
    }

    if ($close)
    {
        $db->close();
    }

    return $options;
}

function get_options_from_array($data, $valueColumn, $displayColumn)
{
    $options = '';

    foreach($data as &$row)
    {
        $options .= '<option value="'. $row->$valueColumn .'">'.$row->$displayColumn.'</option>';
    }

    return $options;
}

?>
