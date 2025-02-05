<!-- admin.php -->
<?php
$pageTitle = "Admin Login";
include 'header.php';
include 'config.php';

if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            header("Location: contact-list.php");
            exit;
        }
    }
    echo '<p class="error">Invalid credentials!</p>';
}
?>

<form method="POST">
    <div class="form-group">
        <label>Username:</label>
        <input type="text" name="username" required>
    </div>
    <div class="form-group">
        <label>Password:</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit" name="login" class="btn">Login</button>
</form>

<?php include 'footer.php'; ?>