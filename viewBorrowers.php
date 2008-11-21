<?php

require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");   //Session
require_once("inc/config.php"); //configs

$link = connect();
if($link == null)
   die("Database connection failed");

// Authenticate
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
$query = "SELECT username, name, rin, email, address, city, state, zipcode, phone
                 FROM logins, borrower_addresses, addresses
		 WHERE addresses.address_id=borrower_addresses.address_id AND
		       borrower_addresses.user_id=logins.id";
                 
$result = mysqli_query($link, $query);
$borrowers = array();

while($item = mysqli_fetch_object($result))
{
	$borrowers [] = $item;
}

//BEGIN Page


$smarty->assign('title', "View Borrowers");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'viewBorrowers');
$smarty->assign('borrowers', $borrowers);


$smarty->display('index.tpl');

mysqli_close($link);

?>