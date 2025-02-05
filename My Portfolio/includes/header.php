<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Portfolio</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
  <nav class="main-nav">
    <div class="nav-container">
      <a href="home.php" class="brand">MyPortfolio</a>
      <div class="nav-links">
        <a href="home.php"><i class="fas fa-home"></i> Home</a>
        <a href="about.php"><i class="fas fa-user"></i> About</a>
        <a href="course_details.php"><i class="fas fa-book"></i> Courses</a>
        <?php if(isset($_SESSION['user_id'])): ?>
          <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
          <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php else: ?>
          <a href="registration.php"><i class="fas fa-user-plus"></i> Register</a>
          <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
  <main class="container">