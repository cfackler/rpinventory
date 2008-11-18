<?php


require_once("inc/connect.php");  //mysql
require_once("inc/config.php");  //configs

$link = connect();
if($link == null)
	die("Database connection failed");
	

// SMARTY Setup

require_once('Smarty.class.php');

$smarty = new Smarty();
$smarty->caching = false;
$smarty->template_dir = template_dir;
$smarty->compile_dir  = compile_dir;
$smarty->config_dir   = config_dir;
$smarty->cache_dir    = cache_dir;



//users
$userQuery= "SELECT id, username, access_level from logins";
$userResult = mysql_query($userQuery, $link);
$users = array();

while($user = mysql_fetch_object($userResult))
{
	$users [] = $user;
}

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "Manage Users");
$smarty->assign('page_tpl', 'manageusers');
$smarty->assign('users', $users);


$smarty->display('index.tpl');



mysql_close($link);

?>