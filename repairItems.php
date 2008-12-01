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


//grab all ids
$idString = $_GET["ids"];
$token = strtok($idString, ",");
$idList = array();
$itemDesc = array();

while ($token !== false) {
	$idList[] = (int)$token;
    $token = strtok(",");
}

//Verify all ids are valid,  get item description
$items = array();
foreach ($idList as $id)
{
	$result = mysqli_query($link, "select * from inventory where inventory_id = " . $id);
	if(mysqli_num_rows($result) == 0)
		die("Invalid item ID");
	
	$item = mysqli_fetch_object($result);
	$items[] = $item;
}


	

//businesses list
$bizQuery= "SELECT company_name, business_id FROM businesses";
$bizResult = mysqli_query($link, $bizQuery);
$businesses = array();

while($biz = mysqli_fetch_object($bizResult))
{
	$businesses [] = $biz;
}

//BEGIN Page


	
//Assign vars
$smarty->assign('title', "Repair Items");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'repairItems');
$smarty->assign('items', $items);
$smarty->assign('itemCount', count($items));
$smarty->assign('idString', $idString);
$smarty->assign('businesses', $businesses);
$smarty->assign('selectDate', getdate(time()));

$smarty->display('index.tpl');



mysqli_close($link);

?>
