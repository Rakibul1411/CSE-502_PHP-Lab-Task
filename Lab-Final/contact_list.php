<!-- contact-list.php -->
<?php
include 'config.php';
$pageTitle = "Contact List";
include 'header.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: admin.php");
    exit;
}

// Fetch contacts
$sql = "SELECT * FROM contacts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<h1>Contact Submissions</h1>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['subject']) ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="logout.php" class="btn">Logout</a>

<?php include 'footer.php'; ?>