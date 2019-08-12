<?php
ob_start();
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");// HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Cache: no-cache");
include('../include/dbc.php');
include('../include/functions.php');
session_regenerate_id();
$_SESSION['user_id'] = "";
$_SESSION['username'] = "";
$_SESSION['user_level'] = "";
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['user_level']);
session_unset();
session_destroy();
if(!isset($_SESSION['user_id']) || $_SESSION['user_id']=="")	
  header("location:".$webUrl."admin");	
ob_end_flush();
?> 
