<?php
session_start();
include "config.php";

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    $stmt = $conn->prepare("SELECT id, password FROM `user` WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $stored_password);
        $stmt->fetch();

        if ($password === $stored_password) {  
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;

            if ($remember) {
                setcookie("user_id", $user_id, time() + (86400), "/");
                setcookie("username", $username, time() + (86400), "/");
            }

            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>

            <div class="remember-container">
                <label><input type="checkbox" name="remember"> Remember Me</label>
                <button type="submit">Log In</button>
            </div>
        </form>
    </div>
</body>
</html>
