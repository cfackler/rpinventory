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



//Business List

$businessQuery = "SELECT business_id, company_name FROM businesses";
$businessResult = mysqli_query($link, $businessQuery);
$businesses = array();

while($business = mysqli_fetch_object($businessResult))
{
	$businesses [] = $business;
}

//User list
$itemQuery= "SELECT inventory_id, description FROM inventory";
$itemResult = mysqli_query($link, $itemQuery);
$items = array();

while($item = mysqli_fetch_object($itemResult))
{
	$items [] = $item;
}

//BEGIN Page


	
//Assign vars
$smarty->assign('title', "Loan Items");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'purchaseItem');
$smarty->assign('items', $items);
$smarty->assign('businesses', $businesses);
$smarty->assign('selectDate', getdate(time()));

$smarty->display('index.tpl');



mysqli_close($link);

?>
