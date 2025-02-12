<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style-for-formh3.css" />
    <title>Form</title>
</head>

<body>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "faculty_of_accounting";

        // Create database connection
        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Sanitize inputs using the established connection
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $father_name = mysqli_real_escape_string($conn, $_POST['fa_name']);
        $mother_name = mysqli_real_escape_string($conn, $_POST['mo_name']);
        $parmanent_address = mysqli_real_escape_string($conn, $_POST['pa_add']);
        $present_address = mysqli_real_escape_string($conn, $_POST['pre_add']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $religion = mysqli_real_escape_string($conn, $_POST['religion']);
        $blood_group = mysqli_real_escape_string($conn, $_POST['bg']);
        $expert_on = mysqli_real_escape_string($conn, $_POST['e_on']);
        $interest_in = mysqli_real_escape_string($conn, $_POST['i_in']);
        $about_yourself = mysqli_real_escape_string($conn, $_POST['ays']);
        $institution_name1 = mysqli_real_escape_string($conn, $_POST['in_name1']);
        $board1 = mysqli_real_escape_string($conn, $_POST['board1']);
        $group1 = mysqli_real_escape_string($conn, $_POST['group1']);
        $passing_year1 = mysqli_real_escape_string($conn, $_POST['py1']);
        $institution_name2 = mysqli_real_escape_string($conn, $_POST['in_name2']);
        $board2 = mysqli_real_escape_string($conn, $_POST['board2']);
        $group2 = mysqli_real_escape_string($conn, $_POST['group2']);
        $passing_year2 = mysqli_real_escape_string($conn, $_POST['py2']);
        $institution_name3 = mysqli_real_escape_string($conn, $_POST['in_name3']);
        $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
        $student_id = mysqli_real_escape_string($conn, $_POST['si']);
        $session = mysqli_real_escape_string($conn, $_POST['session']);

        // Prepared statement for insertion
        $sql = "INSERT INTO `accounting` (`full name`, `father name`, `mother name`, `par add`, `pre add`, `date of birth`, `mobile`, `email`, `religion`, `blood group`, `interested in`, `expert on`, `about yourself`, `institution name`, `board`, `group`, `passing year`, `institution name2`, `board2`, `group2`, `passing year2`, `institution name3`, `faculty`, `student id`, `session`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";    



        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssssssssssssss", $full_name, $father_name, $mother_name, $parmanent_address, $present_address, $dob, $mobile, $email, $religion, $blood_group, $expert_on, $interest_in, $about_yourself, $institution_name1, $board1, $group1, $passing_year1, $institution_name2, $board2, $group2, $passing_year2, $institution_name3, $faculty, $student_id, $session);

        $stmt->execute();
        $stmt->close();
        $conn->close();


        header("Location: log.php");
        exit();
    }
?>

    <div class="container3">
        <div class="image-bg">
            <div class="container">
                <form id="form" method="post" action="http://localhost/bsmru_student_information/form_cse.php">
                    <div class="form">
                        <div class="personal-info">
                            <div class="pi">
                                <h3>Personal Information</h3>
                            </div>
                            <div class="input-field1">
                                <label class="info">*Full Name :</label>
                                <input type="text" class="input" id="full_name" name="full_name" />
                                <span id="full_name-error" class="error"></span>
                            </div>
                            <div class="input-field1">
                                <label>*Father's Name :</label>
                                <input type="text" class="input" id="father_name" name="fa_name" />
                                <span id="father_name-error" class="error"></span>
                            </div>
                            <div class="input-field1">
                                <label>*Mother's Name :</label>
                                <input type="text" class="input" id="mother_name" name="mo_name" />
                                <span id="mother_name-error" class="error"></span>
                            </div>
                            <div class="input-field1">
                                <label>*Parmanent Address :</label>
                                <input type="text" class="input" id="parmanent_address" name="pa_add" />
                                <span id="parmanent_address-error" class="error"></span>
                            </div>
                            <div class="input-field1">
                                <label>*Present Address :</label>
                                <input type="text" class="input" id="present_address" name="pre_add" />
                                <span id="present_address-error" class="error"></span>
                            </div>
                            <div class="me">
                                <div class="input-field">
                                    <label>*Mobile :</label>
                                    <input type="text" class="input" id="mobile" name="mobile" />
                                    <span id="mobile-error" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label>*E-mail :</label>
                                    <input type="text" class="input" id="email" name="email" />
                                    <span id="email-error" class="error"></span>
                                </div>
                            </div>
                            <div class="drb">
                                <div class="input-field">
                                    <label>*Date of Birth :</label>
                                    <input type="date" class="input" id="date_of_birth" name="dob"
                                        placeholder="YYYY-MM-DD" />
                                    <span id="date_of_birth-error" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label>*Religion :</label>
                                    <input type="text" class="input" id="religion" name="religion" />
                                    <span id="religion-error" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label>*Blood Group :</label>
                                    <input type="text" class="input" id="blood_group" name="bg" />
                                    <span id="blood_group-error" class="error"></span>
                                </div>
                            </div>
                            <div class="input-field expart-on">
                                <label for="expert-on">Expert On:</label>
                                <textarea type="text" class="input" name="e_on" id="expert-on"
                                    placeholder="Describe your expertise...(within 150 words)"></textarea>
                                <span id="expert-on-error" class="error"></span>
                            </div>
                            <div class="input-field expart-on">
                                <label for="interest-in">Interest In:</label>
                                <textarea type="text" class="input" name="i_in" id="interest-in"
                                    placeholder="What are your interests? Explain...(within 150 words)"></textarea>
                                <span id="interest-in-error" class="error"></span>
                            </div>
                            <div class="input-field expart-on">
                                <label for="about-yourself">About Yourself:</label>
                                <textarea type="text" class="input" name="ays" id="about-yourself"
                                    placeholder="Write something about yourself...(within 500 words)"></textarea>
                                <span id="about-yourself-error" class="error"></span>
                            </div>
                        </div>
                        <div class="institution">
                            <div class="institution-info1">
                                <div class="ssc pi">
                                    <h3>SSC</h3>
                                </div>
                                <div class="input-field">
                                    <label>*Institution Name :</label>
                                    <input type="text" class="input" id="institution_name" name="in_name1" />
                                    <span id="institution_name-error" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label>*Board :</label>
                                    <input type="text" class="input" id="board" name="board1" />
                                    <span id="board-error" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label>*Group :</label>
                                    <input type="text" class="input" id="group" name="group1" />
                                    <span id="group-error" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label>*Passing Year :</label>
                                    <input type="text" class="input" id="passing_year" name="py1" />
                                    <span id="passing_year-error" class="error"></span>
                                </div>
                            </div>

                            <div class="institution-info2">
                                <div class="ssc pi">
                                    <h3>HSC</h3>
                                </div>
                                <div class="input-field">
                                    <label>*Institution Name :</label>
                                    <input type="text" class="input" id="institution_name2" name="in_name2" />
                                    <span id="institution_name2-error" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label>*Board :</label>
                                    <input type="text" class="input" id="board2" name="board2" />
                                    <span id="board2-error" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label>*Group :</label>
                                    <input type="text" class="input" id="group2" name="group2" />
                                    <span id="group2-error" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label>*Passing Year :</label>
                                    <input type="text" class="input" id="passing_year2" name="py2" />
                                    <span id="passing_year2-error" class="error"></span>
                                </div>
                            </div>
                            <div class="institution-info3">
                                <div class="ssc pi">
                                    <h3>B.Sc</h3>
                                </div>
                                <div class="input-field">
                                    <label>*Institution Name :</label>
                                    <input type="text" class="input" id="institution_name3" name="in_name3" />
                                    <span id="institution_name3-error" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label>*Faculty :</label>
                                    <input type="text" class="input" id="faculty" name="faculty" />
                                    <span id="faculty-error" class="error"></span>
                                </div>
                                <div class="ss">
                                    <div class="input-field">
                                        <label>*Student ID :</label>
                                        <input type="text" class="input" id="id" name="si" />
                                        <span id="id-error" class="error"></span>
                                    </div>
                                    <div class="input-field">
                                        <label>*Session :</label>
                                        <input type="text" class="input" id="session" name="session" />
                                        <span id="session-error" class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit">
                        <button id="sub" class="s"  type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
   <script src="formValidation7.js"></script>
</html>
