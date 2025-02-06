<?php
include 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember_me']);

    $stmt = $conn->prepare("SELECT id, password FROM `user` WHERE username = ?");
    if (!$stmt) die("Prepare failed: " . $conn->error);
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $stored_password);
        $stmt->fetch();

        if ($password === $stored_password) {
            // Set session parameters before starting the session
            if ($remember) {
                $expiryTime = time() + 10;
                session_set_cookie_params($expiryTime - time()); // Set session cookie expiry
            }

            session_start();
            session_regenerate_id(true); // Prevent session fixation
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;

            if ($remember) {
                // Set cookies for "Remember Me"
                setcookie("user_id", $user_id, $expiryTime, "/");
                setcookie("username", $username, $expiryTime, "/");
                setcookie("expires", $expiryTime, $expiryTime, "/");
            }

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