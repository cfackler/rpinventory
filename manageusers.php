<?php


require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //Session
require_once("inc/config.php");  //configs

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();	
if($auth != 2)
	die("You dont have permission to access this page");

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
$userResult = mysqli_query($link, $userQuery);
$users = array();

while($user = mysqli_fetch_object($userResult))
{
	$users [] = $user;
}

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "Manage Users");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'manageusers');
$smarty->assign('users', $users);


$smarty->display('index.tpl');



mysqli_close($link);

?>