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

$sql = "select * from `user` where id = " . $_GET["id"];

//echo $sql;

if ($result = $conn->query($sql)) {
  //echo "Query executed successfully";
}
if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " -Email: ". $row["email"]. " <br>";
    }
} else {
echo "0 results";
}
$conn->close();
?>


</div>
<?php
include("footer.php");
?>