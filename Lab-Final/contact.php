<!-- contact.php -->
<?php
$pageTitle = "Contact Me";
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->escape_string($_POST['subject']);
    $message = $conn->escape_string($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $sql = "INSERT INTO contacts (name, email, subject, message) 
                VALUES ('$name', '$email', '$subject', '$message')";
        
        if ($conn->query($sql) === TRUE) {
            echo '<p class="success">Message sent successfully!</p>';
        } else {
            echo '<p class="error">Error: ' . $conn->error . '</p>';
        }
    } else {
        echo '<p class="error">All fields are required!</p>';
    }
}
?>

<form method="POST" action="contact.php">
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="input-field" required>
    </div>
    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" class="input-field" required>
    </div>
    <div class="form-group">
        <label>Subject:</label>
        <input type="text" name="subject" class="input-field" required>
    </div>
    <div class="form-group">
        <label>Message:</label>
        <textarea name="message" class="input-field" required></textarea>
    </div>
    <button type="submit" class="btn">Submit</button>
</form>

<?php include 'footer.php'; ?>