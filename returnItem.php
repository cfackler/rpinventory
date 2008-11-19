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


//id
$id = (int)$_GET["id"];
if($id == 0)
	die("Invalid ID");


//Loan status
$loanQuery = "Select description from inventory, loans where inventory.inventory_id = loans.inventory_id and loan_id = " . $id;
$loanResult = mysqli_query($link, $loanQuery);

$status = "None";
if(mysqli_num_rows($loanResult) == 0)
	die("Invalid Loan ID");

$loanItem = mysqli_fetch_object($loanResult);

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "Loan Item");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'returnLoan');
$smarty->assign('item', $loanItem);
$smarty->assign('loan_id', $id);
$smarty->assign('selectDate', getdate(time()));

$smarty->display('index.tpl');



mysqli_close($link);

?>
