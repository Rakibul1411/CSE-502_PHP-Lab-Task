<?php
session_start();
$_SESSION['logout_message'] = "You have been successfully logged out!";
session_destroy();
header('Location: index.php');
exit();
?>