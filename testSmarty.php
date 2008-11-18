<?php


require_once("inc/config.php");  //configs


// SMARTY Setup

require_once('Smarty.class.php');

$smarty = new Smarty();
$smarty->caching = false;
$smarty->template_dir = template_dir;
$smarty->compile_dir  = compile_dir;
$smarty->config_dir   = config_dir;
$smarty->cache_dir    = cache_dir;



	
//Assign vars
$smarty->assign('title', "TITLE");
$smarty->assign('page_tpl', 'main');


$smarty->display('index.tpl');

?>