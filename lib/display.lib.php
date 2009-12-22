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
function get_options($tableName, $valueColumn, $displayColumn)
{
    require_once('class/database.class.php');

    // Connect
    $db = new database();

    $query = 'SELECT '.$valueColumn.', '.$displayColumn.' FROM '.$tableName;
    $result = $db->query($query);

    $options = '';
    while($item = $db->getObject($result))
    {
        $options .= '<option value="'.$item->$valueColumn.'">'.$item->$displayColumn.'</option>';
    }

    return $options;

}

?>
