<?php
// Start the session to store login status
session_start();

// Include the database configuration file
require_once 'includes/congfig.php';  // Ensure the correct file name here

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form input values
    $email = $_POST['user_name'];
    $password = $_POST['password'];

    // Query to retrieve the user with the specified email
    $sql = "SELECT * FROM users WHERE user_name = ?";
    $stmt = $conn->prepare($sql);

    // Check if the statement preparation was successful
    if ($stmt === false) {
        echo "Error preparing the SQL query: " . $conn->error;
        exit;
    }

    // Bind parameters and execute the query
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Debugging: Print the hashed password from the database and the submitted password
    if ($user) {
        echo "Stored Hash: " . $user['password'] . "<br>";  // Print the stored hash
        echo "Submitted Password: " . $password . "<br>";  // Print the submitted password

        // Validate the credentials
        if (password_verify($password, $user['password'])) {  // Check password using password_verify()
            // Set session variables for login status
            $_SESSION['logged_in'] = true;
            $_SESSION['user_name'] = $user_name;

            // Redirect to the admin panel (contact list page)
            header('Location: contact-list.php');
            exit;
        } else {
            // Incorrect password
            $error_message = "Invalid password. Please try again.";
        }
    } else {
        // No user found with the given email
        $error_message = "No user found with that email. Please try again.";
    }
}
?>

<?php include 'includes/header.php'; ?>

<main>
    <h1>Admin Login</h1>
    <p>Please enter your credentials to log in:</p>

    <?php
    // Display error message if set
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <!-- Login Form -->
    <form action="admin.php" method="POST">  <!-- Correct the action if needed -->
        <label for="user_name">Username:</label>
        <input type="text" id="user_name" name="user_name" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>
