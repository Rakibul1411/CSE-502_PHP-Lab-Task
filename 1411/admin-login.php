<?php
// Start the session to store login status
session_start();

// Include the database configuration file
require_once 'includes/congfig.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to retrieve the user with the specified name
    $sql = "SELECT * FROM `users` WHERE name = ?";
    $stmt = $conn->prepare($sql);

    // Check if the statement preparation was successful
    if ($stmt === false) {
        error_log("Database error: " . $conn->error);
        die("An error occurred. Please try again later.");
    }

    // Bind parameters and execute the query
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Validate the credentials
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables for login status
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user['id']; // Assuming your table has an 'id' column

        // Redirect to the admin panel
        header('Location: contact-list.php');
        exit;
    } else {
        $error_message = "Invalid username or password. Please try again.";
    }
}