<?php
include 'auth.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    if (loginUser($email, $pass)) {
        if ($_SESSION['verify'] == 0) {
            header("Location: verify.php");
        } else {
            header("Location: dashboard.php");
        }
        exit;
    } else {
        $error = "Vale email või parool!";
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Takenncs template</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: linear-gradient(rgba(15,23,42,0.9), rgba(15,23,42,1)), url('png/1.png');">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md text-gray-800">
        <form method="post" class="space-y-6">
            <div class="relative z-0 w-full group">
                <input type="email" name="email" id="email" required
                       class="block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer"
                       placeholder=" "/>
                <label for="email" class="absolute text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
            </div>
            <div class="relative z-0 w-full group">
                <input type="password" name="password" id="password" required
                       class="block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer"
                       placeholder=" "/>
                <label for="password" class="absolute text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Parool</label>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white p-3 rounded-lg hover:bg-green-700 transition duration-200 font-medium">Logi sisse</button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-700">Sul ei ole kontot? <a href="register.php" class="text-blue-600 hover:underline">Registreeru</a></p>
    </div>

<?php if($error): ?>
    <div id="notify" class="fixed bottom-6 right-6 bg-red-500 text-white px-5 py-3 rounded-xl shadow-2xl flex items-center space-x-3 opacity-0 translate-y-10 transition-all duration-500 ease-in-out max-w-sm z-50" role="alert" aria-live="assertive">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="text-sm font-medium"><?= htmlspecialchars($error) ?></span>
    </div>
    <script>
        const notify = document.getElementById('notify');
        setTimeout(() => {
            notify.classList.remove('opacity-0', 'translate-y-10');
        }, 100);
        setTimeout(() => {
            notify.classList.add('opacity-0', 'translate-y-10');
            setTimeout(() => notify.remove(), 500);
        }, 4000);
    </script>
<?php endif; ?>
</body>
</html>
    <!-- Edasi tee ise nuub -->
