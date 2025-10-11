<?php
include 'auth.php';

if (!checkAuth()) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['verify']) && $_SESSION['verify'] == 1) {
    header("Location: dashboard.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['accept_terms'])) {
        $errors[] = "Pead nõustuma serveri tingimustega, et jätkata!";
    } else {
        $stmt = $db->prepare("UPDATE users SET verify = 1 WHERE uid = ?");
        $stmt->execute([$user_id]);
        $_SESSION['verify'] = 1;

        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>takenncs template</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a2e0adf4ff.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="css/verify.css">
</head>
<body class="min-h-screen bg-slate-900 bg-cover bg-center text-gray-100 flex items-center justify-center py-10"
      style="background-image: linear-gradient(rgba(15,23,42,0.9), rgba(15,23,42,1)), url('png/1.png');">

<main class="container max-w-4xl mx-auto bg-white text-gray-900 p-8 rounded-2xl shadow-2xl fade-in">

<div class="text-center mb-10">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full mb-4">
            <i class="fas fa-file-contract text-white text-2xl"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Serveri tingimused</h1>
        <p class="text-gray-600">Template lisa tekst siia</p>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded-lg flex items-start">
            <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-3"></i>
            <div>
                <p class="text-red-700 font-medium">Viga</p>
                <p class="text-red-600"><?= implode('<br>', array_map('htmlspecialchars', $errors)) ?></p>
            </div>
        </div>
    <?php endif; ?>
    <div class="space-y-6 text-gray-700 mb-10">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
            <h3 class="font-bold text-xl text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                Oluline teave
            </h3>
            <p class="text-gray-700">Template lisa tekst siia</p>
        </div>

        <h3 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Serveri reeglid:</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="rule-item bg-gray-50 p-5 rounded-xl border border-gray-200 hover:border-green-300">
                <div class="flex items-start mb-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-user-check text-green-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Base</h4>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Template lisa tekst siia</p>
            </div>
            <div class="rule-item bg-gray-50 p-5 rounded-xl border border-gray-200 hover:border-red-300">
                <div class="flex items-start mb-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-ban text-red-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Keelustused</h4>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Template lisa tekst siia</p>
            </div>
            <div class="rule-item bg-gray-50 p-5 rounded-xl border border-gray-200 hover:border-yellow-300">
                <div class="flex items-start mb-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-theater-masks text-yellow-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Rollimängu juhised</h4>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Template lisa tekst siia</p>
            </div>
            <div class="rule-item bg-gray-50 p-5 rounded-xl border border-gray-200 hover:border-blue-300">
                <div class="flex items-start mb-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-shield-alt text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Privaatsus</h4>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Template lisa tekst siia</p>
            </div>
            <div class="rule-item bg-gray-50 p-5 rounded-xl border border-gray-200 hover:border-purple-300 md:col-span-2">
                <div class="flex items-start mb-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-headset text-purple-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Probleemide teatamine</h4>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Template lisa tekst siia</p>
            </div>
        </div>
    </div>

    <form method="POST" class="mt-8">
        <div class="checkbox-container bg-gray-50 p-6 rounded-xl border-2 border-gray-200 transition-all duration-300 focus-within:border-green-400">
            <label class="flex items-start space-x-4 cursor-pointer">
                <div class="flex-shrink-0 mt-1">
                    <input type="checkbox" name="accept_terms" class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500" required>
                </div>
                <div>
                    <span class="font-bold text-gray-800 text-lg block mb-2">Nõustun serveri tingimuste ja reeglitega</span>
                    <span class="text-gray-600">Template lisa tekst siia</span>
                </div>
            </label>
        </div>
        <button type="submit" 
                class="w-full mt-8 bg-gradient-to-r from-green-600 to-emerald-700 text-white font-semibold py-4 px-6 rounded-xl hover:from-green-700 hover:to-emerald-800 transition-all duration-300 transform hover:-translate-y-1 shadow-lg pulse-accept focus:outline-none focus:ring-4 focus:ring-green-300">
            <i class="fas fa-check-circle mr-2"></i> Nõustun
        </button>
    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.querySelector('input[name="accept_terms"]');
        const submitButton = document.querySelector('button[type="submit"]');
             checkbox.addEventListener('change', function() {
            if (this.checked) {
                submitButton.classList.remove('opacity-75');
            } else {
                submitButton.classList.add('opacity-75');
            }
        });
            if (!checkbox.checked) {
            submitButton.classList.add('opacity-75');
        }
    });
</script>
</body>
</html>
