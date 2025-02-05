<?php
// Database configuration
define('DB_SERVER', 'localhost');  // Database server (localhost if local)
define('DB_USERNAME', 'root');     // Database username
define('DB_PASSWORD', '');         // Database password
define('DB_NAME', 'lab_final');    // Database name

// Create a connection to the database
try {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
