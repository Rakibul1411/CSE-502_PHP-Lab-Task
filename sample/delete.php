<?php
require("db_config.php");
include("header.php");
include("menu.php");
?>
<div id="main_content">

<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

$sql = "delete from `user` where id = " . $_GET["id"];

//echo $sql;

if ($conn->query($sql)) {
  echo "data deleted successfully";
}
else {
echo "there was an error, please try again later!!!";
}
$conn->close();
?>


</div>
<?php
include("footer.php");
?>