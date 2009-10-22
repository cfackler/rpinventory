<?php

function insertCategory($category_name)
{
	require_once('lib/connect.lib.php');  //mysql
  require_once('lib/auth.lib.php');  //Session
  
  // Authenticate
  $auth = GetAuthority();	
  if($auth<1)
    die('Please login to complete this action');
  
  $link = connect();
  if($link == null)
    die('Database connection failed');

	if(strlen($category_name) == 0)
	{
		die('Category must have a name');
	}

	//sanitize input
	$category_name = mysqli_real_escape_string($link, $category_name);
	
	//check for duplicate category
	$query = 'SELECT category_name FROM categories WHERE category_name="'.$category_name.'"';
	$result = mysqli_query($link, $query) or die('Selecting categories failed: '.mysqli_error($link));
	if(mysqli_num_rows($result) > 0 )
	{
		die('Category already exists.  Please choose from list.');
	}
	
	$query = 'INSERT INTO categories (category_name) VALUES ("'.$category_name.'")';
	mysqli_query($link, $query) or die('Inserting category failed: '.mysqli_error($link));
	
	mysqli_close($link);
	return 'success';  
}

function get_item_category_ids($item_id)
{
	require_once('lib/connect.lib.php');  //mysql
  require_once('lib/auth.lib.php');  //Session
  session_start();

	$_SESSION['item_old_categoryIDs-'.$item_id] = array();
	
  // Authenticate
  $auth = GetAuthority();	
  if($auth<1)
    die('Please login to complete this action');
  
  $link = connect();
  if($link == null)
    die('Database connection failed');

	/* Retrieve all category IDs */
	$query = 'SELECT inventory_category.category_id
						FROM inventory_category
						WHERE inventory_category.inventory_id='.$item_id;
						
	$result = mysqli_query($link, $query) or die ('Error getting category ids: '.mysqli_error($link));
	if(mysqli_num_rows($result) == 0)
		die('Error, no categories retrieved');
	
	/* format the ids separated by commas 5,3,2 */
	$ids = mysqli_fetch_object($result)->category_id;
	$_SESSION['item_old_categoryIDs-'.$item_id][] = $ids;
	while($id = mysqli_fetch_object($result))
	{
		$_SESSION['item_old_categoryIDs-'.$item_id] [] = $id->category_id;
		$ids .= ','.$id->category_id;
	}
	return $ids;
}

?>