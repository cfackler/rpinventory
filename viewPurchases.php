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



//users
$query= "SELECT purchases.purchase_id, purchases.business_id, businesses.business_id, purchases.purchase_date, company_name, total_price, purchase_items.inventory_id, inventory.inventory_id, inventory.description
	 FROM purchases, businesses, purchase_items, inventory
	 WHERE businesses.business_id=purchases.business_id 
	 AND purchase_items.purchase_id= purchases.purchase_id
	 AND purchase_items.inventory_id= inventory.inventory_id";
$result = mysqli_query($link, $query);
$purchases = array();

while($purchase = mysqli_fetch_object($result))
{
	$purchases [] = $purchase;
}

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "View Purchases");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewPurchases');
$smarty->assign('purchases', $purchases);


$smarty->display('index.tpl');



mysqli_close($link);

?>