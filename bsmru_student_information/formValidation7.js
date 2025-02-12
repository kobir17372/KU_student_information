document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    // Clear previous errors
    document.querySelectorAll(".error").forEach(function (el) {
        el.textContent = "";
    });

    let isValid = true;

    // Helper function to display error messages
    function showError(id, message) {
        document.getElementById(id + "-error").textContent = message;
        isValid = false;
    }

    // Fetch form values
    const fullName = document.getElementById("full_name").value.trim();
    const fatherName = document.getElementById("father_name").value.trim();
    const motherName = document.getElementById("mother_name").value.trim();
    const permanentAddress = document.getElementById("parmanent_address").value.trim();
    const presentAddress = document.getElementById("present_address").value.trim();
    const mobile = document.getElementById("mobile").value.trim();
    const email = document.getElementById("email").value.trim();
    const dob = document.getElementById("date_of_birth").value.trim();
    const religion = document.getElementById("religion").value.trim();
    const bloodGroup = document.getElementById("blood_group").value.trim();
    const expertOn = document.getElementById("expert-on").value.trim();
    const interestIn = document.getElementById("interest-in").value.trim();
    const aboutYourself = document.getElementById("about-yourself").value.trim();
    const institutionName = document.getElementById("institution_name").value.trim();
    const board = document.getElementById("board").value.trim();
    const group = document.getElementById("group").value.trim();
    const passingYear = document.getElementById("passing_year").value.trim();
    const institutionName2 = document.getElementById("institution_name2").value.trim();
    const board2 = document.getElementById("board2").value.trim();
    const group2 = document.getElementById("group2").value.trim();
    const passingYear2 = document.getElementById("passing_year2").value.trim();
    const institutionName3 = document.getElementById("institution_name3").value.trim();
    const faculty = document.getElementById("faculty").value.trim();
    const studentId = document.getElementById("id").value.trim();
    const session = document.getElementById("session").value.trim();

    // Validate required fields
    if (!fullName) showError("full_name", "Full name is required.");
    if (!fatherName) showError("father_name", "Father's name is required.");
    if (!motherName) showError("mother_name", "Mother's name is required.");
    if (!permanentAddress) showError("parmanent_address", "Permanent address is required.");
    if (!presentAddress) showError("present_address", "Present address is required.");
    
    if (!mobile) {
        showError("mobile", "Mobile number is required.");
    } else if (!/^(?:\+8801[3-9]\d{8}|01[3-9]\d{8})$/.test(mobile)) {
        showError("mobile", "Invalid mobile number format.");
    }
    
    if (!email) {
        showError("email", "Email is required.");
    } else if (!/^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) {
        showError("email", "Enter a valid email address.");
    }

    // Special date of birth validation
    if (dob) {
        const dobDate = new Date(dob);
        const today = new Date();
        const age = today.getFullYear() - dobDate.getFullYear();
        const ageLimit = 18;
        const maxAge = 100;

        if (dobDate > today) {
            showError("date_of_birth", "Date of Birth cannot be in the future");
        } else if (age < ageLimit) {
            showError("date_of_birth", `You must be at least ${ageLimit} years old`);
        } else if (age > maxAge) {
            showError("date_of_birth", `Age cannot exceed ${maxAge} years`);
        }
    } else {
        showError("date_of_birth", "Date of Birth is required.");
    }

    if (!religion) showError("religion", "Religion is required.");
    if (!bloodGroup) {
    showError("blood_group", "Blood group is required.");
    } else {
        const bloodGroupPattern = /^(A|B|AB|O)(\+|\-)$/;

        if (!bloodGroup.match(bloodGroupPattern)) {
            showError("blood_group", "Please enter a valid blood group (e.g., A+, B-, AB+, O-).");
        }
    }

    // Validate textarea fields
    if (expertOn.length > 150) showError("expert-on", "Expert On must not exceed 150 characters.");
    if (interestIn.length > 150) showError("interest-in", "Interest In must not exceed 150 characters.");
    if (aboutYourself.length > 500) showError("about-yourself", "About Yourself must not exceed 500 characters.");

    // Validate education details
    if (!institutionName) showError("institution_name", "SSC institution name is required.");
    if (!board) showError("board", "SSC board is required.");
    if (!group) showError("group", "SSC group is required.");
    if (!passingYear || !/^\d{4}$/.test(passingYear)) {
    showError("passing_year", "SSC passing year must be a 4-digit year.");
    } else {
        const currentYear = new Date().getFullYear();
        if (passingYear > currentYear) {
            showError("passing_year", "Passing year cannot be in the future.");
        } else if (passingYear < 1900) {
            showError("passing_year", "Passing year must be greater than 1900.");
        }
    }



    if (!institutionName2) showError("institution_name2", "HSC institution name is required.");
    if (!board2) showError("board2", "HSC board is required.");
    if (!group2) showError("group2", "HSC group is required.");
    if (!passingYear2 || !/^\d{4}$/.test(passingYear2)) {
        showError("passing_year2", "HSC passing year must be a 4-digit year.");
    } else {
        const currentYear = new Date().getFullYear();
        if (passingYear2 > currentYear) {
            showError("passing_year2", "Passing year cannot be in the future.");
        } else if (passingYear2 < 1900) {
            showError("passing_year2", "Passing year must be greater than 1900.");
        }
    }

    if (!institutionName3) showError("institution_name3", "Institution name is required.");
    if (!faculty) showError("faculty", "Faculty is required.");
    if (!studentId) {
    showError("id", "Student ID is required.");
    } else {
        const idPattern = /^202([1-4])2([1-4])10([1-4])0(0[1-9]|[1-2][0-9]|30)$/;
        const match = studentId.match(idPattern);

        if (!match) {
            showError("id", "Invalid Student ID format.");
        } else {
            const firstNumber = parseInt(match[1], 10); // X in 202X
            const secondNumber = parseInt(match[2], 10); // Y in 2Y
            const lastNumber = parseInt(match[4], 10); // W in Z000W

            // Validate the sequential logic
            if (secondNumber !== firstNumber + 1) {
                showError("id", `Invalid sequence! The second number must be ${firstNumber + 1}.`);
            } else if (lastNumber < 1 || lastNumber > 30) {
                showError("id", "Invalid last number! It must be between 01 and 30.");
            }
        }
    }


    if (!session) {
    showError("session", "Session is required.");
    } else {
        const sessionPattern = /^202([1-4])-2([1-4])$/;
        const match = session.match(sessionPattern);

        if (!match) {
            showError(
                "session",
                "Invalid session format. It must start with '202', followed by a number (1-4), '-2', and then a number (1-4)."
            );
        } else {
            const fourthDigit = parseInt(match[1], 10); // Extract 4th digit (X)
            const sixthDigit = parseInt(match[2], 10); // Extract 6th digit (Y)

            if (sixthDigit !== fourthDigit + 1) {
                showError(
                    "session",
                    "The 6th digit must be greater than the 4th digit by exactly 1."
                );
            }
        }
    }


    // Submit form if valid
    if (isValid) {
        // Submit the form after validation success
        document.querySelector("form").submit();
    }
});          