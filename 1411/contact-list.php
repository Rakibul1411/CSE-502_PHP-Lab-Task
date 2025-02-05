<?php 
include 'includes/header.php'; 

// Start the session to manage user login/logout


// Check if the logout button is clicked
if (isset($_GET['logout'])) {
    // Destroy the session to log the user out
    session_destroy();
    // Redirect to the homepage or login page after logout
    header("Location: index.php");
    exit();
}
?>

<main>
    <h1>Contact Messages</h1>
    <p>Here are the messages from users who contacted me through the form:</p>

    <!-- Logout Button -->
    <form method="GET" action="">
        <button type="submit" name="logout" value="true" style="padding: 10px 20px; font-size: 16px; background-color: #f44336; color: white; border: none; cursor: pointer;">
            Logout
        </button>
    </form>

    <?php
    // Include the database configuration file
    require_once 'includes/congfig.php';

    // Query to retrieve messages from the database
    $sql = "SELECT * FROM `1411` ORDER BY created_at DESC";
    $result = $conn->query($sql);

    // Check if there are any messages
    if ($result->num_rows > 0) {
        // Display messages in a table
        echo "<table border='1' cellpadding='10' cellspacing='0'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Submitted On</th>
                    </tr>
                </thead>
                <tbody>";

        // Loop through each row and display the message in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
            echo "<td>" . nl2br(htmlspecialchars($row['message'])) . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>No messages found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</main>

<?php include 'includes/footer.php'; ?>
