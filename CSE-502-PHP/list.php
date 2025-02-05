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
  echo "<table border='1'>";
  echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>";
  while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["id"] . "</td>";
      echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
      echo "<td>" . $row["email"] . "</td>";
      echo "<td><a href='details.php?id=" . $row["id"] . "'>detail</a> | <a href='delete.php?id=" . $row["id"] . "'>delete</a> | <a href='edit.php?id=" . $row["id"] . "'>edit</a></td>";
      echo "</tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

$conn->close();
?>


</div>
<?php
include("footer.php");
?>