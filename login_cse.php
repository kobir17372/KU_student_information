

<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bsmru_sri";

    // Establish database connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get user input
    $email_or_number = $_POST['number_email'] ?? '';
    $student_id = $_POST['id'] ?? '';
    $user_password = $_POST['user_pass'] ?? '';

    // Validate input fields
    if (empty($student_id) || empty($email_or_number) || empty($user_password)) {
        echo "<script>alert('All fields are required.');</script>";
        exit();
    }

    // Prepare the SQL query
    $check_sql = "SELECT * FROM `user_register` WHERE `id` = ? AND (`email` = ? OR `number` = ?)";
    $stmt = $conn->prepare($check_sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sss", $student_id, $email_or_number, $email_or_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // No user found
        echo "<script>alert('No account found. Please register.'); 
        window.location.href = 'register.php';</script>";
    } else {
        // User exists, fetch data
        $row = $result->fetch_assoc();
        $dbpassword = $row['password'];

        // Compare password (use password_verify if hashed)
        if ($user_password === $dbpassword) { 
            // Save user data in session
            $_SESSION['student_id'] = $row['id']; // Store student ID in session
            $_SESSION['name'] = $row['name']; // (Optional) Store user's name or other data

            // Redirect to profile page
            header("Location: http://localhost/bsmru_student_information/profile_for_cse.php?id=" . $row['id']);
            exit();
        } else {
            // Wrong password
            echo "<script>alert('Wrong password. Please try again.');</script>";
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Log-in-pannel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style-for-login5.css" />
</head>

<body>

<div class="bg-image2">
  <form action="login_cse.php" method="POST">
    <div class="input-section">
      <h1 class="register log">sign in</h1>
      <div class="email">
        <i class="fa-solid fa-envelope"></i>
        <input class="input box" type="text" placeholder="Phone number or E-mail" name="number_email" required />
      </div>
      <div class="email">
        <i class="fa-regular fa-id-card"></i>
        <input class="input box" type="text" placeholder="Student ID" name="id" required />
      </div>
      <div class="pass">
        <i class="fa-solid fa-key"></i>
        <input class="input box" type="password" placeholder="Password" name="user_pass" required />
        <div><a href="forgot-password.php">Forgotten Password?</a></div>
      </div>
      <div class="sign-pannel">
        <div class="signup">
          <button type="button" class="signupbtn" onclick="window.location.href='register.php'">register</button>
        </div>
        <div class="signin">
          <button type="submit" class="signinbtn" name="sign_in">log in</button>
        </div>
      </div>
    </div>
  </form>
</div>

</body>

</html>