<?php
session_start();
include './includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $pdo->prepare("SELECT first_name, last_name, email, contact, address FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>About Me</title>
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">About Me</h2>

        <?php if ($user): ?>
            <div class="card mx-auto mt-4" style="max-width: 500px;">
                <div class="card-body">
                    <h4 class="card-title text-center"><?php echo htmlspecialchars($user['first_name'] . " " . $user['last_name']); ?></h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
                        <li class="list-group-item"><strong>Contact:</strong> <?php echo htmlspecialchars($user['contact']); ?></li>
                        <li class="list-group-item"><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></li>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center text-muted">User details not found.</p>
        <?php endif; ?>

        <div class="text-center mt-3">
            <a href="home.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
