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
$query= "SELECT inventory.inventory_id, inventory.description, location, current_condition, current_value
		FROM inventory, locations
		WHERE locations.location_id=inventory.location_id";
$result = mysqli_query($link, $query);
$items = array();

while($item = mysqli_fetch_object($result))
{
	$items [] = $item;
}

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "View Inventory");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewinventory');
$smarty->assign('items', $items);


$smarty->display('index.tpl');



mysqli_close($link);

?>