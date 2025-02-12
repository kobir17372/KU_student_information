
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Information for English Department</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style_for_information15.css" />
</head>

<body>
  <div class="body-section">
    <div class="scroll-watcher"></div>
    <header class="nav-section">
      <div class="head-text">
        <div class="logo"></div>
        <div class="name-head">
          <h1>STUDENT INFORMATION</h1>
          <p id="varsity-name">
            <br /> UNIVERSITY OF KISHOREGANJ
          </p>
        </div>
      </div>

      <div class="nav-menu">
        <div class="nav-option">
          <div class="icon_home">
            <!-- Menu Icon -->
              <i class="fa-solid fa-bars menu-icon" onclick="toggleSidebar()"></i>

              <!-- Sidebar -->
              <div class="sidebar" id="sidebar">
                  <span class="close-btn" onclick="toggleSidebar()">&times;</span>
                  <a href="#">Home</a>
                  <a href="#">CSE</a>
                  <a href="#">Mathematics</a>
                  <a href="#">English</a>
                  <a href="#">Accounting</a>
                  <a href="#">About us</a>
              </div>

              <!-- Overlay -->
              <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

              <script>
                  function toggleSidebar() {
                      document.getElementById("sidebar").classList.toggle("open");
                      document.getElementById("overlay").classList.toggle("show");
                  }
              </script>

            <a id="home" href="http://localhost/bsmru_student_information/">HOME</a>
          </div>

          <div class="search-bar">
            <select>
              <option id="option-place">All</option>
            </select>
            <input id="search-place" name="search" placeholder="Enter Name..." onkeyup="searchStudent()" />
            <div class="search-icon">
              <i class="fa-solid fa-magnifying-glass"></i>
            </div>
          </div>

          <div class="dropdown-container">
              <div class="dropdown">
                  <a href="#" class="dropdown-header">English</a>
                  <div class="dropdown-menu">
                      <a href="http://localhost/bsmru_student_information/dept_of_cse.php">CSE</a>
                      <a href="http://localhost/bsmru_student_information/dept_of_math.php">MAT</a>
                      <a href="http://localhost/bsmru_student_information/dept_of_accounting.php">ACC</a>
                  </div>
              </div>
          </div>
          <div class="log-in-panel">
              <div class="log-in">
                  <a class="button" href="http://localhost/bsmru_student_information/link.php">Log-in</a>
              </div>
              <div class="register">
                  <a class="button" href="http://localhost/bsmru_student_information/register.php">Register</a>
              </div>
          </div>

        </div>
      </div>
    </header>
  </div>

<div class="result" id="search-results" style="margin-left: 30%;"></div>


  <!-- PHP Script: Move this to a separate file like 'search-option.php' -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "faculty_of_english";

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} // Ensure this file connects to your database correctly

// Fetch all profiles with batch sorting
$query = "SELECT `student id`, `full name`, `mother name`, `father name`, `par add`, `pre add`, `session`,`profile pic` FROM english";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $batches = []; // Array to store students by batch

        while ($row = mysqli_fetch_assoc($result)) {
            // Extract session part from `session` field (e.g., 2021-22, 2022-23)
            preg_match('/(\d{4})-(\d{2})/', $row['session'], $matches);
            if ($matches) {
                $sessionStart = intval($matches[1]); // Extract starting year (e.g., 2021)
                $batchNumber = $sessionStart - 2021 + 1; // Calculate batch (2021-22 = Batch 1)

                // Group by batch
                $batches[$batchNumber][] = $row;
            }
        }

        // Sort batches in ascending order by batch number
        ksort($batches);

        // Display data batch-wise
        echo "<div class='container'>";
        foreach ($batches as $batch => $students) {
            echo "<div class='batch'><h2>Batch $batch</h2></div>"; // Display batch header
            foreach ($students as $student) {
              $profilePic = !empty($student['profile pic']) ? "uploads/" . htmlspecialchars($student['profile pic']) : "";
                echo "
                <div class='profile'>
                    <div class='profile-pic'>
                        <img src='" . $profilePic . "?t=" . time() . "''>
                    </div>
                    <div class='name'><h2>" . htmlspecialchars($student['full name']) . "</h2></div>
                    <div class='all-name'>
                        <div class='fa-name pi'><b>Father name:</b> " . htmlspecialchars($student['father name']) . "</div>
                        <div class='ma-name pi'><b>Mother name:</b> " . htmlspecialchars($student['mother name']) . "</div>
                        <div class='pa-address pi'><b>Par address:</b> " . htmlspecialchars($student['par add']) . "</div>
                        <div class='pre-address pi'><b>Pres address:</b> " . htmlspecialchars($student['pre add']) . "</div>
                        <div class='view-more-btn'>
                            <a href='profile_for_eng.php?id=" . htmlspecialchars($student['student id']) . "'>View Profile</a>
                        </div>
                    </div>
                </div>";
            }
        }
        echo "</div>";
    } else {
        echo "<p>No profiles found.</p>";
    }
} else {
    echo "<p>Error fetching profiles: " . mysqli_error($conn) . "</p>";
}


//--searching algorithm---

  if (isset($_POST["search"])) {
      $search = trim($_POST["search"]);
      $searchTerm = "%$search%";

      $stmt = $conn->prepare("SELECT `student id`, `full name`, `mother name`, `father name`, `par add`, `pre add`FROM `english`WHERE `full name` LIKE ?");
      if ($stmt) {
          $stmt->bind_param("s", $searchTerm);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "
                  <div class='profile'>
                      <div class='profile-pic'></div>
                      <div class='name'><h2>" . htmlspecialchars($row['full name']) . "</h2></div>
                      <div class='all-name'>
                          <div class='fa-name pi'><b>Father name:</b> " . htmlspecialchars($row['father name']) . "</div>
                          <div class='ma-name pi'><b>Mother name:</b> " . htmlspecialchars($row['mother name']) . "</div>
                          <div class='pa-address pi'><b>Par address:</b> " . htmlspecialchars($row['par add']) . "</div>
                          <div class='pre-address pi'><b>Pres address:</b> " . htmlspecialchars($row['pre add']) . "</div>
                          <div class='view-more-btn'>
                              <a href='profile_for_eng.php?id=" . htmlspecialchars($row['student id']) . "'>View Profile</a>
                          </div>
                      </div>
                  </div>";
              }
          } else {
            echo "<div class='no-results'><p >No results found for '$search'.</p></div>";
          }
          $stmt->close();
      }
  }
  ?>

  <script>
    function searchStudent() {
      const query = document.getElementById("search-place").value;

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "search_eng_dept.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          document.getElementById("search-results").innerHTML = xhr.responseText;
        }
      };
      xhr.send("search=" + encodeURIComponent(query));
    }
  </script>
  
  
</body>
   <footer class="footer">
     <div class="footer-top">
        <a href="index.php" class="back-to-top">Back to Top</a>
      </div>
    <div class="footer-content">

        <!-- Quick Links -->
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        <!-- Departments -->
        <div class="footer-section">
            <h3>Departments</h3>
            <ul>
                <li><a href="#">CSE</a></li>
                <li><a href="#">MAT</a></li>
                <li><a href="#">ENG</a></li>
                <li><a href="#">ACC</a></li>
            </ul>
        </div>

        <!-- Builder Info -->
        <div class="footer-section builder-info">
            <h3>Builder Information</h3>
            <div class="b-image"></div>
            <p>Md. Kobir Hossain</p>
            <p>Kishoreganj University</p>
            <p>Email: <a href="mailto:kobir.17372@gmail.com">kobir.17372@gmail.com</a></p>
            <p>Phone: 01317372031</p>
        </div>

        <!-- Social Media Links -->
        <div class="footer-section social">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        &copy; 2025 BSMRU | All Rights Reserved.
    </div>

</html>