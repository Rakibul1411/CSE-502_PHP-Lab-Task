<?php
$con = mysqli_connect("localhost","root","","testing");

if (!$con) {
  echo "<script>alert('Cannot connect to the database')</script>";
  exit();
}
?>