<?php
if (!isset($_SESSION)) {
/* session not started */
session_start();
}
$nonce=md5(rand(0,65337 ).time()); //generates the salt
$_SESSION['nonce']=$nonce; //stored in the session object
?>

