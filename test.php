<?php
session_start();
$loggedIn = isset($_SESSION['student_id']);

if (!$loggedIn) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "faculty_of_cse";

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the student ID from the session
$student_id = $_SESSION['student_id'];

// Fetch user data
$stmt = $conn->prepare("SELECT * FROM `cse` WHERE `student id` = ?");
$stmt->bind_param('i', $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    header("Location: error.php?error=no_data_found");
    exit();
}

$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
    $mother_name = mysqli_real_escape_string($conn, $_POST['mother_name']);
    $parmanent_address = mysqli_real_escape_string($conn, $_POST['parmanent_address']);
    $present_address = mysqli_real_escape_string($conn, $_POST['present_address']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $expert_on = mysqli_real_escape_string($conn, $_POST['expert_on']);
    $interest_in = mysqli_real_escape_string($conn, $_POST['interest_in']);
    $about_yourself = mysqli_real_escape_string($conn, $_POST['about_yourself']);
    $institution_name1 = mysqli_real_escape_string($conn, $_POST['institution_name1']);
    $board1 = mysqli_real_escape_string($conn, $_POST['board1']);
    $group1 = mysqli_real_escape_string($conn, $_POST['group1']);
    $passing_year1 = mysqli_real_escape_string($conn, $_POST['passing_year1']);
    $institution_name2 = mysqli_real_escape_string($conn, $_POST['institution_name2']);
    $board2 = mysqli_real_escape_string($conn, $_POST['board2']);
    $group2 = mysqli_real_escape_string($conn, $_POST['group2']);
    $passing_year2 = mysqli_real_escape_string($conn, $_POST['passing_year2']);
    $institution_name3 = mysqli_real_escape_string($conn, $_POST['institution_name3']);
    $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
    $session = mysqli_real_escape_string($conn, $_POST['session']);

    // Update the database
    $stmt = $conn->prepare("UPDATE `cse` SET 
        `full name` = ?, 
        `father name` = ?, 
        `mother name` = ?, 
        `par add` = ?, 
        `pre add` = ?, 
        `mobile` = ?, 
        `email` = ?, 
        `date of birth` = ?, 
        `religion` = ?, 
        `blood group` = ?, 
        `expert on` = ?, 
        `interested in` = ?, 
        `about yourself` = ?, 
        `institution name` = ?, 
        `board` = ?, 
        `group` = ?, 
        `passing year` = ?, 
        `institution name2` = ?, 
        `board2` = ?, 
        `group2` = ?, 
        `passing year2` = ?, 
        `institution name3` = ?, 
        `faculty` = ?,
        `student id`=?, 
        `session` = ? 
        WHERE `student id` = ?");

    $stmt->bind_param("sssssssssssssssssssssssssi", 
        $full_name, $father_name, $mother_name, $parmanent_address, $present_address, 
        $mobile, $email, $dob, $religion, $blood_group, $expert_on, $interest_in, 
        $about_yourself, $institution_name1, $board1, $group1, $passing_year1, 
        $institution_name2, $board2, $group2, $passing_year2, $institution_name3, 
        $faculty, $session, $student_id);

    if ($stmt->execute()) {
            header("Location: profile_for_cse.php?id=" . $row['id']);
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="edit.css"> <!-- Use the same CSS as the profile page -->
</head>
<body>
    <div class="profile">
        <h2>Edit Profile</h2>
        <form method="POST">
            <!-- Personal Details -->
            <label>Full Name:</label>
            <input type="text" name="full_name" value="<?php echo htmlspecialchars($row['full name']); ?>" required><br>

            <label>Father's Name:</label>
            <input type="text" name="father_name" value="<?php echo htmlspecialchars($row['father name']); ?>"><br>

            <label>Mother's Name:</label>
            <input type="text" name="mother_name" value="<?php echo htmlspecialchars($row['mother name']); ?>"><br>

            <label>Permanent Address:</label>
            <input type="text" name="parmanent_address" value="<?php echo htmlspecialchars($row['par add']); ?>"><br>

            <label>Present Address:</label>
            <input type="text" name="present_address" value="<?php echo htmlspecialchars($row['pre add']); ?>"><br>

            <label>Phone Number:</label>
            <input type="text" name="mobile" value="<?php echo htmlspecialchars($row['mobile']); ?>"><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"><br>

            <label>Date of Birth:</label>
            <input type="date" name="dob" value="<?php echo htmlspecialchars($row['date of birth']); ?>"><br>

            <label>Religion:</label>
            <input type="text" name="religion" value="<?php echo htmlspecialchars($row['religion']); ?>"><br>

            <label>Blood Group:</label>
            <input type="text" name="blood_group" value="<?php echo htmlspecialchars($row['blood group']); ?>"><br>

            <!-- Academic Details -->
            <label>SSC Institution Name:</label>
            <input type="text" name="institution_name1" value="<?php echo htmlspecialchars($row['institution name']); ?>"><br>

            <label>SSC Board:</label>
            <input type="text" name="board1" value="<?php echo htmlspecialchars($row['board']); ?>"><br>

            <label>SSC Group:</label>
            <input type="text" name="group1" value="<?php echo htmlspecialchars($row['group']); ?>"><br>

            <label>SSC Passing Year:</label>
            <input type="text" name="passing_year1" value="<?php echo htmlspecialchars($row['passing year']); ?>"><br>

            <label>HSC Institution Name:</label>
            <input type="text" name="institution_name2" value="<?php echo htmlspecialchars($row['institution name2']); ?>"><br>

            <label>HSC Board:</label>
            <input type="text" name="board2" value="<?php echo htmlspecialchars($row['board2']); ?>"><br>

            <label>HSC Group:</label>
            <input type="text" name="group2" value="<?php echo htmlspecialchars($row['group2']); ?>"><br>

            <label>HSC Passing Year:</label>
            <input type="text" name="passing_year2" value="<?php echo htmlspecialchars($row['passing year2']); ?>"><br>

            <label>Honours Institution Name:</label>
            <input type="text" name="institution_name3" value="<?php echo htmlspecialchars($row['institution name3']); ?>"><br>

            <label>Faculty:</label>
            <input type="text" name="faculty" value="<?php echo htmlspecialchars($row['faculty']); ?>"><br>
            
            <label>Student ID:</label>
            <input type="text" name="id" value="<?php echo htmlspecialchars($row['student id']); ?>"><br>

            <label>Session:</label>
            <input type="text" name="session" value="<?php echo htmlspecialchars($row['session']); ?>"><br>

            <!-- Expertise and Bio -->
            <label>Expert On:</label>
            <input type="text" name="expert_on" value="<?php echo htmlspecialchars($row['expert on']); ?>"><br>

            <label>Interested In:</label>
            <input type="text" name="interest_in" value="<?php echo htmlspecialchars($row['interested in']); ?>"><br>

            <label>About Yourself:</label>
            <textarea name="about_yourself"><?php echo htmlspecialchars($row['about yourself']); ?></textarea><br>

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>