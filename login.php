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



$loginStatus = "none";
if(isset($_GET['login']) && $_GET['login'] == "fail")
{
	$loginStatus = "fail";
}
	
//Assign vars
$smarty->assign('title', "Login");
$smarty->assign('loginStatus', $loginStatus);
$smarty->assign('page_tpl', 'login');


$smarty->display('index.tpl');



mysqli_close($link);

?>