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
	
	$category_name = mysqli_real_escape_string($link, $category_name);
	$query = 'INSERT INTO categories (category_name) VALUES ("'.$category_name.'")';
	mysqli_query($link, $query) or die('Inserting category failed: '.mysqli_error($link));
	
	mysqli_close($link);
	return 'success';  
}


?>