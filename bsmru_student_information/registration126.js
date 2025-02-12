document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault();

    // Clear previous errors
    document.querySelectorAll(".error").forEach(function (el) {
        el.textContent = "";
    });

    let isValid = true;

    function showError(id, message) {
        document.querySelector(`.${id}-error`).textContent = message;
        isValid = false;
    }

    const name = document.getElementById("namebox").value.trim();
    const mobile = document.getElementById("number").value.trim();
    const email = document.getElementById("email").value.trim();
    const studentId = document.getElementById("id").value.trim();
    const password = document.getElementById("passbox").value.trim();
    const r_password = document.getElementById("r-passbox").value.trim();

    if (!name) showError("name", "Name is required.");
    else if (!/^[a-zA-Z\s.-]+$/.test(name)) showError("name", "Invalid name format.");

    if (!mobile) showError("number", "Mobile number is required.");
    else if (!/^(?:\+8801[3-9]\d{8}|01[3-9]\d{8})$/.test(mobile)) showError("number", "Invalid mobile number format.");

    if (!email) showError("email", "Email is required.");
    else if (!/^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) showError("email", "Enter a valid email address.");

    if (!studentId) {
        showError("id", "Student ID is required.");
    } else {
        const idPattern = /^202([1-4])2([1-4])10([1-4])0(0[1-9]|[1-2][0-9]|30)$/;
        const match = studentId.match(idPattern);
        if (!match) {
            showError("id", "Invalid Student ID format.");
        } else {
            const firstNumber = parseInt(match[1], 10);
            const secondNumber = parseInt(match[2], 10);
            const lastNumber = parseInt(match[4], 10);

            if (secondNumber !== firstNumber + 1) {
                showError("id", `Invalid sequence! The second number must be ${firstNumber + 1}.`);
            } else if (lastNumber < 1 || lastNumber > 30) {
                showError("id", "Invalid last number! It must be between 01 and 30.");
            }
        }
    }

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (!password) showError("pass", "Password is required.");
    else if (!passwordRegex.test(password)) {
        showError(
            "pass",
            "Password must be at least 8 characters, including uppercase, lowercase, number, and special character."
        );
    }

    if (!r_password) showError("r-pass", "Please confirm your password.");
    else if (password !== r_password) showError("r-pass", "Passwords do not match.");

    if (isValid) {
        document.querySelector("form").submit();
    }
});
