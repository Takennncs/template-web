<?php
include 'auth.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';
    if($name && $email && $pass){
        registerUser($name, $email, $pass);
        header("Location: login.php");
        exit;
    } else {
        $error = "Täida kõik väljad!";
    }
}
?>

<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>takenncs template</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: linear-gradient(rgba(15,23,42,0.9), rgba(15,23,42,1)), url('png/1.png');">
<div class="bg-white p-8 rounded shadow-md w-96 text-gray-800">
    <?php if(isset($error)) echo "<p class='text-red-500 mb-4'>$error</p>"; ?>
    <form method="post" class="space-y-6">
        <div class="relative z-0 w-full group">
            <input type="text" name="name" id="name" required
                   class="block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder=" "/>
            <label for="name" class="absolute text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nimi</label>
        </div>
        <div class="relative z-0 w-full group">
            <input type="email" name="email" id="email" required
                   class="block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder=" "/>
            <label for="email" class="absolute text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
        </div>
        <div class="relative z-0 w-full group">
            <input type="password" name="password" id="password" required
                   class="block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder=" "/>
            <label for="password" class="absolute text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Parool</label>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700 transition duration-200">Registreeru</button>
    </form>
    <p class="mt-4 text-center text-sm text-gray-700">Sul on juba konto? <a href="login.php" class="text-blue-600 hover:underline">Logi sisse</a></p>
</div>
</body>
</html>
    <!-- Edasi tee ise nuub -->
