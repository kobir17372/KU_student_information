<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Selection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes floatEffect {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        .animate-float {
            animation: floatEffect 2s infinite ease-in-out;
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen bg-gradient-to-r from-[rgb(68,23,82)] to-[rgb(129,116,160)] text-white">
    <div class="bg-[rgb(168,136,181)] bg-opacity-90 p-8 rounded-xl shadow-2xl w-96 text-center animate-float">
        <h2 class="text-2xl font-semibold mb-4 text-[rgb(184, 99, 126)]">Which department are you a part of ?</h2>
        <div class="space-y-3">
            <a href="http://localhost/bsmru_student_information/login_cse.php" class="block py-3 px-5 bg-[rgb(88,33,102)] text-[rgb(239,192,210)] rounded-lg shadow-lg hover:bg-[rgb(149,126,170)] transition-transform transform hover:scale-110">Computer Science & Engineering</a>
            <a href="http://localhost/bsmru_student_information/login_math.php" class="block py-3 px-5 bg-[rgb(129,116,160)] text-[rgb(239,192,210)] rounded-lg shadow-lg hover:bg-[rgb(168,136,181)] transition-transform transform hover:scale-110">Mathematics</a>
            <a href="http://localhost/bsmru_student_information/login_eng.php" class="block py-3 px-5 bg-[rgb(168,136,181)] text-[rgb(68,23,82)] rounded-lg shadow-lg hover:bg-[rgb(239,182,200)] transition-transform transform hover:scale-110">English</a>
            <a href="http://localhost/bsmru_student_information/login_acc.php" class="block py-3 px-5 bg-[rgb(239,182,200)] text-[rgb(88,33,102)] rounded-lg shadow-lg hover:bg-[rgb(129,116,160)] transition-transform transform hover:scale-110">Accounting</a>
        </div>
    </div>
</body>
</html>
