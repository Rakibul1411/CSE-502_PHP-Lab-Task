<?php
require("db_config.php");
include("header.php");
include("menu.php");
?>
<div id="main_content">
<br><br><br>
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

        echo '<form action="editaction.php" method="post">';
            echo 'First Name: <input type="text" name="fname" value="' .  $row["firstname"] . '"/> <br>';
            echo 'Last Name: <input type="text" name="lname" value="' .  $row["lastname"] . '"/><br>';
            echo 'Email: <input type="email" name="email" value="' .  $row["email"] . '"/><br>';
            echo '<input type="hidden" name="id" value="' .  $row["id"] . '"/>';
            echo '<input type="submit" name="submit" value="Submit"/><br>';
        echo '</form>';


        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " -Email: ". $row["email"]. " <br>";
    }
} else {
echo "no data found results";
}
$conn->close();
?>


</div>
<?php
include("footer.php");
?>