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


//item
$query= "SELECT inventory.inventory_id, inventory.description, location, locations.location_id, current_condition, current_value  FROM inventory, locations WHERE locations.location_id=inventory.location_id and inventory.inventory_id = " . $id;
$result = mysqli_query($link, $query);

if(mysqli_num_rows($result) == 0)
	die("Invalid item ID");

$item = mysqli_fetch_object($result);


//Loan status
$loanQuery = "Select * from loans where return_date is NULL and inventory_id = " . $id;
$loanResult = mysqli_query($link, $loanQuery);


$status = "None";
if(mysqli_num_rows($loanResult) != 0)
	$status = "Out";

//Locations
$userQuery= "SELECT id, username FROM logins";
$userResult = mysqli_query($link, $userQuery);
$users = array();

while($user = mysqli_fetch_object($userResult))
{
	$users [] = $user;
}

//BEGIN Page



	
//Assign vars
$smarty->assign('title', "Loan Item");
$smarty->assign('authority', $auth);
$smarty->assign('page_tpl', 'loanItem');
$smarty->assign('item', $item);
$smarty->assign('users', $users);
$smarty->assign('status', $status);
$smarty->assign('selectDate', getdate(time()));

$smarty->display('index.tpl');



mysqli_close($link);

?>
