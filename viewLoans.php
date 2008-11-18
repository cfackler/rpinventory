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
$query= "SELECT loan_id, loans.inventory_id, username, user_id, issue_date, return_date, starting_condition, username, description  FROM logins, loans, inventory WHERE loans.user_id = logins.id and inventory.inventory_id = loans.inventory_id";


//Filter
if(!isset($_GET['view']))
	$view = "all";
else
	$view = $_GET['view'];

if($view == "outstanding")
{
	$query .= " and return_date IS NULL";
}
else if($view == "returned")
{
	$query .= " and return_date IS NOT NULL";
}


$result = mysql_query($query, $link);
$items = array();

while($item = mysql_fetch_object($result))
{
	$items [] = $item;
}

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "TITLE");
$smarty->assign('page_tpl', 'viewLoans');
$smarty->assign('items', $items);
$smarty->assign('filter', $view);


$smarty->display('index.tpl');



mysql_close($link);

?>