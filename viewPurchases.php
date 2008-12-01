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
$query= "SELECT purchases.purchase_id, purchases.business_id, purchases.purchase_date, company_name, total_price
	 FROM purchases, businesses
	 WHERE businesses.business_id=purchases.business_id ";
$result = mysqli_query($link, $query);
$purchases = array();
$items = array();

while($purchase = mysqli_fetch_object($result))
{
	$purchases [] = $purchase;
	
	
	$itemQuery = "select purchase_id, description from inventory, purchase_items where inventory.inventory_id = purchase_items.inventory_id and purchase_items.purchase_id = " . $purchase->purchase_id;

	$itemResult = mysqli_query($link, $itemQuery);
	$string = "";
	
	while($item = mysqli_fetch_object($itemResult))
	{
		if(strlen($string) != 0)
			$string .= ", ";
			
		$string .= $item->description;
	}
	
	$items[] = $string;
	
}


//BEGIN Page


	
//Assign vars
$smarty->assign('title', "View Purchases");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewPurchases');
$smarty->assign('purchases', $purchases);
$smarty->assign('purchaseItems', $items);

$smarty->display('index.tpl');



mysqli_close($link);

?>