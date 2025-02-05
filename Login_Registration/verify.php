<?php
require("connection.php");

if (isset($_GET["email"]) && isset($_GET["v_code"])) {
    // Sanitize input
    $email = mysqli_real_escape_string($con, $_GET['email']);
    $v_code = mysqli_real_escape_string($con, $_GET['v_code']);

    // Check if the email and verification code exist in the database
    $query = "SELECT * FROM `registered_users` WHERE `email`='$email' AND `verification_code`='$v_code'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);

            // Check if the user is already verified
            if ($result_fetch['is_verified'] == 0) {
                $update = "UPDATE `registered_users` SET `is_verified`=1 WHERE `email`='$email'";
                if (mysqli_query($con, $update)) {
                    echo "
                      <script>
                        alert('Email Verified Successfully');
                        window.location.href='index.php';
                      </script>";
                } else {
                    echo "
                      <script>
                        alert('Cannot Verify Email');
                        window.location.href='index.php';
                      </script>";
                }
            } else {
                echo "
                  <script>
                    alert('User already verified');
                    window.location.href='index.php';
                  </script>";
            }
        } else {
            echo "
              <script>
                alert('Invalid Verification Link');
                window.location.href='index.php';
              </script>";
        }
    } else {
        echo "
          <script>
            alert('Server Down. Please try again later');
            window.location.href='index.php';
          </script>";
    }
}
?>
