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


$id = (int)$_GET['id'];
if($id == 0)
	die("Invalid ID");

//users
$userQuery= "SELECT id, username, access_level from logins where id = " . $id;
$userResult = mysql_query($userQuery, $link);
$user = mysql_fetch_object($userResult);

if($user == false)
	die("Invalid ID");

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "Edit User");
$smarty->assign('page_tpl', 'editUser');
$smarty->assign('user', $user);


$smarty->display('index.tpl');



mysql_close($link);

?>