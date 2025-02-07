<?php
$host = 'localhost';
$username = 'root';  
$password = '';  
$dbname = 'userinfo-theory';  

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $remember = isset($_POST['remember_me']);

  $result = $conn->query("SELECT id, password FROM `user` WHERE username = '$username'");

  if (!$result) {
      die("Query failed: " . $conn->error); 
  }

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc(); // Fetch the row
      $user_id = $row['id'];
      $stored_password = $row['password'];

      // Verify the password
      if ($password === $stored_password) {
          // Set session parameters
          // if ($remember) {
          //     $expiryTime = time() + 10; // Set expiry time (e.g., 10 seconds for testing)
          //     session_set_cookie_params($expiryTime - time()); // Set session cookie expiry
          // }

          if ($remember) {
            $currentTime = time();
            $expiryTime = $currentTime + 10;
            session_set_cookie_params($expiryTime - $currentTime); // Set session cookie expiry
            // Set cookies for "Remember Me"
            setcookie("user_id", $user_id, $expiryTime, "/");
            setcookie("username", $username, $expiryTime, "/");
            setcookie("expires", $expiryTime, $expiryTime, "/");
          }

          session_start();
          session_regenerate_id(true); // Prevent session fixation
          $_SESSION['user_id'] = $user_id;
          // $_SESSION['username'] = $username;

          header("Location: index.php");
          exit;
      } else {
          $error = 'Invalid password.';
      }
  } else {
      $error = 'User not found!';
  }
} else {
  session_start();
  if (isset($_SESSION['user_id'])) {
      header("Location: index.php");
      exit;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="post">
        <div>
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>
                <input type="checkbox" name="remember_me"> Remember me
            </label>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>