<?php


require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //Session
require_once("inc/config.php");  //configs

$link = connect();
if($link == null)
	die("Database connection failed");

//Authenticate
$auth = GetAuthority();	
if($auth < 1)
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
$locQuery= "SELECT * from locations";
$locResult = mysqli_query($link, $locQuery);
$locations = array();

while($loc = mysqli_fetch_object($locResult))
{
	$locations [] = $loc;
}

	
//Assign vars
$smarty->assign('title', "Manage Locations");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'manageLocations');
$smarty->assign('locations', $locations);


$smarty->display('index.tpl');



mysqli_close($link);

?>