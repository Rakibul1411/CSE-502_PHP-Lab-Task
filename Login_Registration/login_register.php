<?php

require('connection.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $v_code){
  require ("PHPMailer/PHPMailer.php");
  require("PHPMailer/SMTP.php");
  require("PHPMailer/Exception.php");

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mdrakibul11611@gmail.com';                     //SMTP username
    $mail->Password   = 'nyyr wcvc xgch lgkf';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('natiqaqif@gmail.com', 'Irony Queen');
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification from Irony Queen';
    $mail->Body    = "Thank for registration. 
    Please click the link below to verify your email address.
    <br><br>
    <a href='http://localhost/Login_Registration/verify.php?email=$email&v_code=$v_code'>Verify Email</a>";

    $mail->send();
    return true;
  } catch (Exception $e) {
      return false;
  }
}

#For Login
if (isset($_POST['login'])) {
  $query = "SELECT * FROM `registered_users` WHERE `email`='$_POST[email_username]' OR `username`='$_POST[email_username]'";

  $result = mysqli_query($con, $query);

  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      $result_fetch = mysqli_fetch_assoc($result);

      if ($result_fetch['is_verified'] == 1) {
        if (password_verify($_POST['password'], $result_fetch['password'])) {
          $_SESSION['logged-in'] = true;
          $_SESSION['username'] = $result_fetch['username'];
          header("location: index.php");
        }
        else {
          echo "
            <script>
              alert('Incorrect Password');
              window.location.href='index.php';
            </script>";
  
        }
      }
      else {
        echo "
          <script>
            alert('Email Not Verified');
            window.location.href='index.php';
          </script>";
      }
    }
    else {
      echo "
      <script>
        alert('Email or Username Not Registered');
        window.location.href='index.php';
      </script>";
    }
  }
  else {
    echo "
      <script>
        alert('Email or Username Not Registered');
        window.location.href='index.php';
      </script>";
  }
}



#For Registration
if (isset($_POST['register'])) { 
  // Sanitize input data to prevent SQL injection
  $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);

  // Check if user already exists
  $user_exist_query = "SELECT * FROM `registered_users` WHERE `username`='$username' OR `email`='$email'";

  $result = mysqli_query($con, $user_exist_query);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      $result_fetch = mysqli_fetch_assoc($result);
      if ($result_fetch['username'] === $username) {
        echo "
          <script>
            alert('$username - Username already exists');
            window.location.href='index.php';
          </script>";
      } elseif ($result_fetch['email'] === $email) {
        echo "
          <script>
            alert('$email - E-mail already registered');
            window.location.href='index.php';
          </script>";
      }
    } else {   
      // Hash the password before storing it
      $hashed_password = password_hash($password, PASSWORD_BCRYPT);

      $v_code = bin2hex(random_bytes(16));

      // Insert new user into the database
      $query = "INSERT INTO `registered_users`(`full_name`, `username`, `email`, `password`, `verification_code`, `is_verified`) VALUES ('$fullname', '$username', '$email', '$hashed_password', '$v_code', '0')";

      if (mysqli_query($con, $query) && sendMail($_POST['email'], $v_code)) {
        echo "
          <script>
            alert('Registration Successful');
            window.location.href='index.php';
          </script>";
      } else {
        // Debugging error
        echo "
          <script>
            alert('Server Down. Please try again later');
            window.location.href='index.php';
          </script>";
      }
    }
  } else {
    // Debugging error
    echo "
      <script>
        alert('Cannot Run Query: " . mysqli_error($con) . "');
        window.location.href='index.php';
      </script>";
  }
}
?>
