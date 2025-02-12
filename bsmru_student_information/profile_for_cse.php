<?php

session_start(); 
$loggedIn = isset($_SESSION['student_id']);

$servername = "localhost";
$username = "root";
$password = "";
$database = "faculty_of_cse";

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $database);


// Get the student ID from the URL and validate it
$student_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($student_id === 0) {
    header("Location: error.php?error=invalid_student_id  2 kobir");
    exit();
}

// Initialize default variables
$currentProfilePic = 'default_profile.jpg'; // Default profile picture
$currentCoverPic = 'default_cover.jpg'; // Default cover picture

// Fetch user data
$stmt = $conn->prepare("SELECT * FROM `cse` WHERE `student id` = ?");
$stmt->bind_param('i', $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentProfilePic = !empty($row['profile pic']) ? $row['profile pic'] : $currentProfilePic;
    $currentCoverPic = !empty($row['cover pic']) ? $row['cover pic'] : $currentCoverPic;
}else {
    header("Location: error.php?error=no_data_found 3");
    exit();
}

$stmt->close();

// Handle profile and cover picture uploads
if ($loggedIn && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'uploads/';
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && is_uploaded_file($_FILES['profile_picture']['tmp_name'])) {
        $profileFile = $_FILES['profile_picture'];
        $profileTempPath = $profileFile['tmp_name'];
        $profileMimeType = mime_content_type($profileTempPath);

        if (in_array($profileMimeType, $allowedTypes)) {
            $profileFilename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($profileFile['name']));
            $profileUploadPath = $uploadDir . $profileFilename;

            if (move_uploaded_file($profileTempPath, $profileUploadPath)) {
                $currentProfilePic = $profileFilename;
            }
        }
    }

    // Handle cover picture upload
    if (isset($_FILES['cover_picture']) && is_uploaded_file($_FILES['cover_picture']['tmp_name'])) {
        $coverFile = $_FILES['cover_picture'];
        $coverTempPath = $coverFile['tmp_name'];
        $coverMimeType = mime_content_type($coverTempPath);

        if (in_array($coverMimeType, $allowedTypes)) {
            $coverFilename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($coverFile['name']));
            $coverUploadPath = $uploadDir . $coverFilename;

            if (move_uploaded_file($coverTempPath, $coverUploadPath)) {
                $currentCoverPic = $coverFilename;
            }
        }
    }

    // Update database
    $stmt = $conn->prepare("UPDATE `cse` SET `profile pic` = ?, `cover pic` = ? WHERE `student id` = ?");
    $stmt->bind_param('ssi', $currentProfilePic, $currentCoverPic, $student_id);
    $stmt->execute();
    $stmt->close();

    // Redirect to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $student_id);
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo htmlspecialchars($row['full name'] ?? 'Profile'); ?>'s Profile</title>
    <link rel="stylesheet" href="profile6.css">
    <script>
        function autoSubmitForm() {
            document.getElementById('uploadForm').submit();
        }
    </script>
</head>
<body>
    <div class="profile">
        <div class="head">
            <form id="uploadForm" method="POST" enctype="multipart/form-data">
                <!-- Cover Photo -->
                <div class="cover-photo">
                    <img class="cover-pic" src="uploads/<?php echo htmlspecialchars($currentCoverPic); ?>" alt="Cover Picture">
                    <?php if ($loggedIn): ?>
                        <div class="upload-container1">
                            <label for="cover_picture" class="upload-label"><i class="fa-solid fa-camera"></i></label>
                            <input type="file" name="cover_picture" id="cover_picture" accept="image/*" onchange="autoSubmitForm()">
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Profile Photo -->
                <div class="profile-photo">
                    <img id="profileimg" class="profile-pic" src="uploads/<?php echo htmlspecialchars($currentProfilePic); ?>" alt="Profile Picture">
                    <?php if ($loggedIn): ?>
                        <div class="upload-container2">
                            <label for="profile_picture" class="upload-label"><i class="fa-solid fa-camera"></i></label>
                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="autoSubmitForm()">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="name">
                    <h2><?php echo htmlspecialchars($row['full name'] ?? 'Unknown'); ?></h2>
                </div>
            </form>
        </div>

        <div class="ae-buton">
                <button id="about-myself">About Myself</button>
                <?php if ($loggedIn): ?>
                    <a href="test.php">
                        <button id="edit">Edit Profile</button>
                    </a>
                <?php endif; ?>
            </div>

            <div class="border1"></div>

            <!-- Personal Details Section -->
            <div class="gap1"><p id="details">Personal details</p></div>
            <div class="about">
                <div class="persional-info">
                    <div class="fa-name pi"><?php echo "<p><b>Father's Name:</b> " . htmlspecialchars($row['father name']) . "</p>"; ?></div>
                    <div class="ma-name pi"><?php echo "<p><b>Mother's Name:</b> " . htmlspecialchars($row['mother name']) . "</p>"; ?></div>
                    <div class="pa-address pi"><?php echo "<p><b>Permanent Address:</b> " . htmlspecialchars($row['par add']) . "</p>"; ?></div>
                    <div class="pre-address pi"><?php echo "<p><b>Present Address:</b> " . htmlspecialchars($row['pre add']) . "</p>"; ?></div>
                    <div class="number pi"><?php echo "<p><b>Phone Number:</b> " . htmlspecialchars($row['mobile']) . "</p>"; ?></div>
                    <div class="email pi"><?php echo "<p><b>Email:</b> " . htmlspecialchars($row['email']) . "</p>"; ?></div>
                    <div class="dob pi"><?php echo "<p><b>Date of Birth:</b> " . htmlspecialchars($row['date of birth']) . "</p>"; ?></div>
                    <div class="religion pi"><?php echo "<p><b>Religion:</b> " . htmlspecialchars($row['religion']) . "</p>"; ?></div>
                    <div class="blood-group pi"><?php echo "<p><b>Blood Group:</b> " . htmlspecialchars($row['blood group']) . "</p>"; ?></div>
                </div>
        <div class="gap1"><p id="details">Academic</p></div>
        <div class="academic">
            <div class="ssc">
                <div class="ssc-top">SSC</div>
                <div class="institution pi"><p><b>Institution Name:</b> <?php echo htmlspecialchars($row['institution name']); ?></p></div>
                <div class="board pi"><p><b>Board:</b> <?php echo htmlspecialchars($row['board']); ?></p></div>
                <div class="group pi"><p><b>Group:</b> <?php echo htmlspecialchars($row['group']); ?></p></div>
                <div class="year pi"><p><b>Passing Year:</b> <?php echo htmlspecialchars($row['passing year']); ?></p></div>
            </div>
            <div class="hsc">
                <div class="hsc-top">HSC</div>
                <div class="institution pi"><p><b>Institution Name:</b> <?php echo htmlspecialchars($row['institution name2']); ?></p></div>
                <div class="board pi"><p><b>Board:</b> <?php echo htmlspecialchars($row['board2']); ?></p></div>
                <div class="group pi"><p><b>Group:</b> <?php echo htmlspecialchars($row['group2']); ?></p></div>
                <div class="year pi"><p><b>Passing Year:</b> <?php echo htmlspecialchars($row['passing year2']); ?></p></div>
            </div>
            <div class="honours">
                <div class="bsc-top">Honours</div>
                <div class="institution pi"><p><b>Institution Name:</b> <?php echo htmlspecialchars($row['institution name3']); ?></p></div>
                <div class="board pi"><p><b>Student ID:</b> <?php echo htmlspecialchars($row['student id']); ?></p></div>
                <div class="group pi"><p><b>Faculty:</b> <?php echo htmlspecialchars($row['faculty']); ?></p></div>
                <div class="year pi"><p><b>Session:</b> <?php echo htmlspecialchars($row['session']); ?></p></div>
            </div>
        </div>

        <!-- Expertise Section -->
        <div class="gap1"><b><p id="details">Expertise</p></b></div>
        <div class="bio">
            <div class="bio-head"><b>Bio</b></div>
            <div class="border2"></div>
            <div class="about-you pi"><p><?php echo htmlspecialchars($row['about yourself']); ?></p></div>
            <div class="expert-head"><b>Expert On</b></div>
            <div class="border3"></div>
            <div class="expert pi"><p><?php echo htmlspecialchars($row['expert on']); ?></p></div>
            <div class="interest-head"><b>Interested In</b></div>
            <div class="border4"></div>
            <div class="interested pi"><p><?php echo htmlspecialchars($row['interested in']); ?></p></div>
        </div>
    </div>
    <div class="log-out">
        <?php if ($loggedIn): ?>
        <form method="POST" action="logout.php">
            <button class="logout-button">Log Out</button>
        </form>
        <?php endif; ?>
    </div>
</body>
<script>
// Force the page to reload when accessed via the back button
window.onpageshow = function(event) {
    if (event.persisted) {
        window.location.reload();
    }
};
</script>

</html>
