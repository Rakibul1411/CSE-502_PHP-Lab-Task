<?php

$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = "";
$DATABASE = 'signupforms';

//connect to the database
$con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE); 

if (!$con) {
  die(mysqli_error($con));
}
?>