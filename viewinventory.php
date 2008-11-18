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



//items
$query= "SELECT inventory.description, location, current_condition, current_value  FROM inventory, locations WHERE locations.location_id=inventory.location_id";
$result = mysql_query($link, $query);
$items = array();

while($item = mysq_fetch_object($result))
{
	$items [] = $item;
}

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "TITLE");
$smarty->assign('page_tpl', 'viewinventory');
$smarty->assign('items', $items);


$smarty->display('index.tpl');



mysqli_close($link);

?>