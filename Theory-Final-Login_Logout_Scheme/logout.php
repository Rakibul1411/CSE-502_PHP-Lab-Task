<?php

session_start();

// Unset all session variables
$_SESSION = array();

session_destroy();


setcookie("user_id", "", time() - 3600, "/");  // 
setcookie("username", "", time() - 3600, "/");  // 
setcookie("expires", "", time() - 3600, "/");   // 

header("Location: login.php");
exit;

?>
