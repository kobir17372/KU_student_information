<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style-for-registration4.css"/>
    <title>Registration</title>
</head>
<body>
    
                
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bsmru_sri";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mobile = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $student_id = mysqli_real_escape_string($conn, $_POST['id']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $r_password = mysqli_real_escape_string($conn, $_POST['r_pass']);

    // Check if the id, number, or email already exists
    $check_sql = "SELECT * FROM `user_register` WHERE `id` = ? OR `number` = ? OR `email` = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("sss", $student_id, $mobile, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If a record is found, display an alert and stop the process
        echo "<script>alert('ID, Mobile Number, or Email already exists! Please use unique values.');</script>";
        echo "<script>window.history.back();</script>"; // Redirects user back to the form
        $stmt->close();
        $conn->close();
        exit();
    }

    $stmt->close();

    // Insert data if no conflict is found
    $insert_sql = "INSERT INTO `user_register` (`name`, `id`, `number`, `email`, `password`, `r_password`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ssssss", $name, $student_id, $mobile, $email, $password, $r_password);

    if ($stmt->execute()) {
        // Show success alert
        echo "<script>alert('Registration successful!');</script>";
        echo "<script>window.location.href = 'link_form.php';</script>"; // Redirect to form.php after success
    } else {
        // Show error alert
        echo "<script>alert('Error during registration. Please try again.');</script>";
        echo "<script>window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>  

<div class="container1">
    <div class="bg-image1">
        <form id="form" method="post" action="http://localhost/bsmru_student_information/register.php">
            <div class="input-section1">
                <h1 id="regi">Registration</h1>
                <div class="un1">
                    <i class="fa-solid fa-user"></i>
                    <input class="input box" id="namebox" required type="text" placeholder="Name" name="name"/>
                    <div class="name-error error"></div>
                </div>
                <div class="id">
                    <i class="fa-regular fa-id-card"></i>
                    <input class="input box" id="id" required type="text" placeholder="Student ID" name="id"/>
                    <div class="id-error error"></div>
                </div>
                <div class="number">
                    <i class="fa-solid fa-phone"></i>
                    <input class="input box" id="number" required type="number" placeholder="Mobile number" name="number"/>
                    <div class="number-error error"></div>
                </div>
                <div class="email1">
                    <i class="fa-solid fa-envelope"></i>
                    <input class="input box" id="email" required type="email" placeholder="E-mail" name="email"/>
                    <div class="email-error error"></div>
                </div>
                <div class="pass1">
                    <i class="fa-solid fa-key"></i>
                    <input class="input box" type="password" id="passbox" required placeholder="Password" name="pass"/>
                    <div class="pass-error error"></div>
                </div>
                <div class="pass1">
                    <i class="fa-solid fa-key"></i>
                    <input class="input box" type="password" id="r-passbox" required placeholder="Retype Password" name="r_pass"/>
                    <div class="r-pass-error error"></div>
                </div>
                <div class="submit">
                    <button class="nextbtn" type="submit" id="submitBtn">Next</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
   <script src="registration126.js"></script>
</html>