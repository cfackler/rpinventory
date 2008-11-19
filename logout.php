<?php

require_once("inc/connect.php");  //mysql
require_once("inc/auth.php");  //authentication


Logout();

header('Location: viewinventory.php');
?>