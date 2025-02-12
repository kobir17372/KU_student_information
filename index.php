<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BSMRU Student Information</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style-for-index8.css" />
</head>

<body>
  <div class="body-section">
    <div class="scroll-watcher"></div>
    <header class="nav-section">
      <div class="head-text">
        <div class="logo"></div>
        <div class="name">
          <h1>STUDENT INFORMATION</h1>
          <p id="varsity-name">
            <br /> UNIVERSITY OF KISHOREGANJ
          </p>
        </div>
      </div>

      <div class="nav-menu">
        <div class="nav-option">
          <div class="icon_home">
            <i class="fa-solid fa-bars menu-icon" onclick="toggleSidebar()"></i>
                <div class="sidebar" id="sidebar">
                    <span class="close-btn" onclick="toggleSidebar()">&times;</span>
                    <a href="#">Home</a>
                    <a href="#">About</a>
                    <a href="#">Services</a>
                    <a href="#">Contact</a>
                </div>

                <!-- Overlay -->
                <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

                <script>
                    function toggleSidebar() {
                        document.getElementById("sidebar").classList.toggle("open");
                        document.getElementById("overlay").classList.toggle("show");
                    }
                </script>
            <a id="home" href="http://127.0.0.1:5500/bsmru_student_information/">HOME</a>
          </div>

          <div class="fc">
            <div class="dropdown-menu">
              <div class="faculty">
                <a href="#" class="f" id="ank">STUDENT INFORMATION</a>
                <div class="dropdown-menu-1">
                  <a href="http://localhost/bsmru_student_information/dept_of_cse.php" id="ank">CSE</a>
                  <a href="http://localhost/bsmru_student_information/dept_of_math.php/" id="ank">MAT</a>
                  <a href="http://localhost/bsmru_student_information/dept_of_english.php" id="ank">ENG</a>
                  <a href="http://localhost/bsmru_student_information/dept_of_accounting.php" id="ank">ACC</a>
                </div>
              </div>
            </div>

            <div class="club">
              <a href="#" class="c" id="ank">CLUB</a>
              <div class="dropdown-menu-1">
                <a href="https://bpc.bsmru.ac.bd/" id="ank">BCPC</a>
                <a href="#" id="ank">MAT</a>
                <a href="#" id="ank">ENG</a>
                <a href="#" id="ank">ACC</a>
              </div>
            </div>
          </div>

          <div class="log-in-pannel">
            <div class="log-in">
              <a id="log" href="http://localhost/bsmru_student_information/link.php">LOG-IN</a>
            </div>
            <div class="register">
              <a id="reg" href="http://localhost/bsmru_student_information/register.php">REGISTER</a>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="hero-section">
      <div class="hero">
        <div class="hero-msg">
            <h1 class="wlc anim">WELCOME <br> TO OUR BSMRU FAMILY</h1>
            <div class="text">
                <p class="anim">Join our BSMRU family as a Student</p>
            </div>
            <div class="log12">
                <a href="#" class="join">Join Now</a>
            </div>
        </div>
      </div>
    </div>

    <div class="image-section">
      <div class="box box1"></div>
      <div class="box box2"></div>
      <div class="box box3"></div>
      <div class="box box4"></div>
      <div class="box box5"></div>
      <div class="box box6"></div>
      <div class="box box7"></div>
      <div class="box box8"></div>
      <div class="box box9"></div>
    </div>
  </div>




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
</footer>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll('.box');

    function checkScroll() {
        elements.forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight * 0.85 && rect.bottom > 0) {
                el.classList.add('scroll-show');
            } else {
                el.classList.remove('scroll-show'); // Removes animation when out of view
            }
        });
    }

    window.addEventListener("scroll", checkScroll);
    checkScroll(); // Run on page load
});


</script>

</html>
