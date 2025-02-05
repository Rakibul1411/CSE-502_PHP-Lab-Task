<?php
session_start();
include './includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the logged-in user's details
$stmt = $pdo->prepare("SELECT first_name, last_name, email, contact, address FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$logged_in_user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch all registered users from the database
$stmt = $pdo->query("SELECT first_name, last_name, email, contact, address FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="semester.php">All Semester</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">User Dashboard</h2>

        <!-- Logged-in User Profile Card -->
        <div class="card mx-auto mt-4 mb-5" style="max-width: 500px;">
            <div class="card-body text-center">
                <h4 class="card-title"><?php echo htmlspecialchars($logged_in_user['first_name'] . " " . $logged_in_user['last_name']); ?></h4>
                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($logged_in_user['email']); ?></p>
                <p class="card-text"><strong>Contact:</strong> <?php echo htmlspecialchars($logged_in_user['contact']); ?></p>
                <p class="card-text"><strong>Address:</strong> <?php echo htmlspecialchars($logged_in_user['address']); ?></p>
            </div>
        </div>

        <!-- All Registered Users -->
        <h3 class="text-center">All Registered Users</h3>

        <?php if (!empty($users)): ?>
            <table class="table table-bordered mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['contact']); ?></td>
                            <td><?php echo htmlspecialchars($user['address']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center text-muted">No registered users found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
