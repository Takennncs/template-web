<?php
include 'auth.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';
    if(loginUser($email, $pass)) {
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Andmed ei klapi";
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
    <div class="bg-white p-8 rounded shadow-md w-96 text-gray-800">
        <?php if (isset($error)): ?>
            <p class="text-red-500 mb-4"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
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
            <button type="submit" class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700 transition duration-200">Logi sisse</button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-700">Sul ei ole kontot? <a href="register.php" class="text-blue-600 hover:underline">Registreeru</a></p>
    </div>
</body>
</html>
    <!-- Edasi tee ise nuub -->
