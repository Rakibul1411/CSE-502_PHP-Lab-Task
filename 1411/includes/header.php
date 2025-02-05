<!DOCTYPE html>
<html>
<head>
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <nav>
            <ul class="nav-menu">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item">
                    <a href="about.php" class="nav-link">About Me</a>
                    <ul class="dropdown">
                        <li><a href="personal-info.php" class="dropdown-item">Personal Info</a></li>
                        <li><a href="education.php" class="dropdown-item">Educational Info</a></li>
                        <li><a href="work.php" class="dropdown-item">Work Info</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact Me</a></li>
                <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
            </ul>
        </nav>
    </header>
    <main class="main-content">