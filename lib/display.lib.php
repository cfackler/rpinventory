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
	require_once('lib/connect.lib.php');
	require_once('lib/auth.lib.php');  //Session

  // Connect
  $link = connect();
  if( $link == null )
    die( 'Database connection failed' );
  
  // Authenticate
  $auth = GetAuthority();
  if($auth < 1)
	  die('You dont have permission to access this page');
	
	$query = 'SELECT '.$valueColumn.', '.$displayColumn.' FROM '.$tableName;
	$result = mysqli_query($link, $query) or die( 'Error selecting from '.$tableName.': '.mysqli_error($link) );

	$options = '';
	while($item = mysqli_fetch_object($result))
	{
		$options .= '<option value="'.$item->$valueColumn.'">'.$item->$displayColumn.'</option>';
	}
	
	return $options;

}

?>