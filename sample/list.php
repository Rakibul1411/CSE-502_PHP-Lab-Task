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

$sql = "select * from `user`";

//echo $sql;

if ($result = $conn->query($sql)) {
  //echo "Query executed successfully";
}
if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " -Email: ". $row["email"]. " <a style='color:white;' href='details.php?id=" . $row["id"] . "'>detail</a> |  <a style='color:white;' href='delete.php?id=" . $row["id"] . "'>delete</a> |  <a style='color:white;' href='edit.php?id=" . $row["id"] . "'>edit</a><br>";
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