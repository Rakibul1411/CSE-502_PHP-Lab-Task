<?php

require_once 'includes/congfig.php';

// Demo user data
$user_name = 'admin'; // Email for the demo user
$password = '123456'; // Demo password

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL query to insert the new demo user
$sql = "INSERT INTO `users` (user_name, password) VALUES (?, ?)";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Check if the statement preparation was successful
if ($stmt === false) {
    echo "Error preparing the SQL query: " . $conn->error;
    exit;
}

// Bind parameters and execute the query
$stmt->bind_param("ss", $user_name, $hashed_password);

if ($stmt->execute()) {
    echo "Demo user inserted successfully!";
} else {
    echo "Error inserting demo user: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
