<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-for-search4.css"/>
    <title>Search Students</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "faculty_of_cse";

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["search"])) {
    $search = trim($_POST["search"]);

    // Secure input against SQL injection
    $searchTerm = "%$search%";

    // Use a prepared statement
    $stmt = $conn->prepare("SELECT `student id`, `full name`, `mother name`, `father name`, `par add`, `pre add`, `profile pic` FROM `cse` WHERE `full name` LIKE ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the parameter
    $stmt->bind_param("s", $searchTerm);

    // Execute the query
    $stmt->execute();

    // Fetch results
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Handle profile picture logic
            $profilePic = !empty($row['profile pic']) ? "uploads/" . htmlspecialchars($row['profile pic']) : "uploads/Default_fpf.jpg";

            echo "
            <div class='profile'>
                <div class='profile-pic'>
                    <img src='" . $profilePic . "?t=" . time() . "' alt='Profile Picture'>
                </div>
                <div class='name'><h2>" . htmlspecialchars($row['full name']) . "</h2></div>
                <div class='all-name'>
                    <div class='fa-name pi'><b>Father name:</b> " . htmlspecialchars($row['father name']) . "</div>
                    <div class='ma-name pi'><b>Mother name:</b> " . htmlspecialchars($row['mother name']) . "</div>
                    <div class='pa-address pi'><b>Par address:</b> " . htmlspecialchars($row['par add']) . "</div>
                    <div class='pre-address pi'><b>Pres address:</b> " . htmlspecialchars($row['pre add']) . "</div>
                    <div class='view-more-btn'>
                        <a href='profile_for_cse.php?id=" . htmlspecialchars($row['student id']) . "'>View Profile</a>
                    </div>
                </div>
            </div>";
        }
    } else {
        echo "<div class='no-results'><p>No results found for '$search'.</p></div>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<script>
  function searchStudent() {
    const query = document.getElementById("search-place").value;

    // AJAX request
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "search_cse_dept.php", true); // Send the search query to a separate PHP script
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById("search-results").innerHTML = xhr.responseText;
      }
    };
    xhr.send("search=" + encodeURIComponent(query)); // Send the query securely
  }
</script>

</body>
</html>
