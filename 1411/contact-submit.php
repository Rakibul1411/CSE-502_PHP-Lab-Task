<?php
// Include the database configuration file
require_once './includes/congfig.php';

// Check if the form is submitted using POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data and sanitize it
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // SQL query to insert the data into the contact_messages table
    $sql = "INSERT INTO `1411` (name, email, subject, message) 
            VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to a thank you page or show success message
        echo "Message sent successfully! Thank you for contacting us.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
