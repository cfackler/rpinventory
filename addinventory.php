<?php


require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //Session
require_once("inc/config.php");  //configs

$link = connect();
if($link == null)
	die("Database connection failed");
	
//Authenticate
$auth = GetAuthority();


// SMARTY Setup

require_once('Smarty.class.php');

$smarty = new Smarty();
$smarty->caching = false;
$smarty->template_dir = template_dir;
$smarty->compile_dir  = compile_dir;
$smarty->config_dir   = config_dir;
$smarty->cache_dir    = cache_dir;



//items
$query= "SELECT location_id, location  FROM locations";
$result = mysqli_query($link, $query);
$locations = array();

while($loc = mysqli_fetch_object($result))
{
	$locations [] = $loc;
}

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "Add Inventory");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'addInventory');
$smarty->assign('locations', $locations);


$smarty->display('index.tpl');



mysqli_close($link);

?>
