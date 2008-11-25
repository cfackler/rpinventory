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
$query= "SELECT company_name, address, address2, city, state, zipcode, phone, fax, email, website
	     FROM businesses, addresses
	     WHERE businesses.address_id=addresses.address_id";
$result = mysqli_query($link, $query);
$businesses = array();

while($business = mysqli_fetch_object($result))
{
	$businesses [] = $business;
}

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "Manage Businesses");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'manageBusinesses');
$smarty->assign('businesses', $businesses);


$smarty->display('index.tpl');



mysqli_close($link);

?>