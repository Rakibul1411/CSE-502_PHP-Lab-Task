<?php

include 'connect.php';

if (isset($_POST['signUp'])) {
    $fName = trim($_POST['fName']);
    $lName = trim($_POST['lName']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic input validation
    if (empty($fName) || empty($lName) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $insertQuery = $conn->prepare("INSERT INTO users (fName, lName, email, password) VALUES (?, ?, ?, ?)");
        $insertQuery->bind_param("ssss", $fName, $lName, $email, $hashedPassword);

        if ($insertQuery->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Email and Password are required.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Validate user credentials
    $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['email'] = $row['email'];
            header("Location: homepage.php");
            exit();
        } else {
            echo "Invalid Email or Password!";
        }
    } else {
        echo "Invalid Email or Password!";
    }
}
?>