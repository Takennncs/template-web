<?php
include 'auth.php';
if (!checkAuth()) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $db->prepare("SELECT * FROM users WHERE uid=?");
$stmt->execute([$user_id]);
$user_info = $stmt->fetch(PDO::FETCH_ASSOC);
$username = htmlspecialchars($user_info['name']);
$user_role = htmlspecialchars($user_info['role'] ?? 'Mängija');
$all_services = ['Konto', 'Steam', 'Discord', 'CFX.re', 'Keelustus'];
$links = [];
?>

<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="png/logo.png">
  <title>takenncs template</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/ucp.css">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="min-h-screen bg-cover bg-center text-white" style="background-image: linear-gradient(rgba(15,23,42,0.9), rgba(15,23,42,1)), url('png/1.png');" x-data="{ activeTab: 'overview', settingsOpen: false }">

<aside class="sidebar fixed top-0 left-0 h-full w-64 bg-gray-900 p-6 flex flex-col">
    <div class="logo mb-8 flex items-center gap-2">
      <img src="png/logo.png" alt="Logo" class="w-10 h-10">
      <h1 class="text-lg font-bold">Breaking San Fierro</h1>
    </div>
    <?php include 'sidebar.php'; ?>
    <div class="mt-auto flex items-center justify-between">
      <div class="flex items-center gap-2">
        <img src="png/unknow.png" alt="Avatar" class="w-10 h-10 rounded-full">
        <div>
          <div class="font-semibold"><?php echo $username; ?></div>
          <div class="text-xs text-gray-400"><?php echo $user_role; ?></div>
        </div>
      </div>
      <button onclick="location.href='logout.php'" title="Logi välja" class="text-red-500 hover:text-red-400"><i class="fas fa-sign-out-alt"></i></button>
    </div>
  </aside>

  <main class="ml-64 p-6 flex-1">
    <header class="flex justify-between items-center mb-6">
      <div>
        <h2 class="text-2xl font-bold">Avaleht</h2>
        <p class="text-gray-300">Wsg, <strong><?php echo $username; ?></strong> — UCP avaleht</p>
      </div>
      <div class="flex gap-2">
        <button class="px-4 py-2 bg-gray-700 rounded hover:bg-gray-600" @click="settingsOpen = true"><i class="fas fa-cog"></i> Seaded</button>
      </div>
    </header>

    <div class="bg-gray-800 rounded-lg p-6 mb-6">
      <div class="flex flex-col md:flex-row gap-6">
        <div class="flex-shrink-0">
          <img src="png/unknow.png" alt="Avatar" class="w-24 h-24 rounded-full border-2 border-blue-500">
        </div>
        <div class="flex-1">
          <h3 class="text-xl font-bold"><?php echo $username; ?></h3>
          <div class="text-gray-400"><?php echo $user_role; ?></div>
          <div class="flex gap-4 mt-4">
            <div class="text-center">
         <!-- TEE ISE nuub -->
            </div>
          </div>
        </div>
      </div>

      <div class="mt-6 flex gap-2 border-b border-gray-700">
        <button class="px-4 py-2" :class="{ 'border-b-2 border-blue-500': activeTab === 'overview' }" @click="activeTab = 'overview'">Ülevaade</button>
        <button class="px-4 py-2" :class="{ 'border-b-2 border-blue-500': activeTab === 'history' }" @click="activeTab = 'history'">Ajalugu</button>
        <button class="px-4 py-2" :class="{ 'border-b-2 border-blue-500': activeTab === 'permissions' }" @click="activeTab = 'permissions'">Õigused</button>
        <button class="px-4 py-2" :class="{ 'border-b-2 border-blue-500': activeTab === 'user_info' }" @click="activeTab = 'user_info'">Kasutaja info</button>
      </div>

      <div class="mt-4">
        <div x-show="activeTab === 'overview'">
          <?php foreach($all_services as $service):
            $status = "text-gray-400"; $text = "Pole ühendatud";
            if($service === 'Konto') {$status="text-green-400"; $text="Ühendatud";}
          ?>
          <div class="flex justify-between p-2 border-b border-gray-700">
            <span><?php echo htmlspecialchars($service); ?></span>
            <span class="<?php echo $status; ?>"><?php echo $text; ?></span>
          </div>
          <?php endforeach; ?>
        </div>

        <div x-show="activeTab === 'history'">
          <p>Toimingud puuduvad</p>
        </div>

        <div x-show="activeTab === 'permissions'">
          <p>Õigused puuduvad</p>
        </div>

        <div x-show="activeTab === 'user_info'">
          <div class="grid grid-cols-2 gap-2">
            <div class="p-2 border-b border-gray-700 flex justify-between"><span>RID</span><span><?php echo $user_info['id']; ?></span></div>
            <div class="p-2 border-b border-gray-700 flex justify-between"><span>Kasutajanimi</span><span><?php echo htmlspecialchars($user_info['name']); ?></span></div>
            <div class="p-2 border-b border-gray-700 flex justify-between"><span>Email</span><span><?php echo htmlspecialchars($user_info['email']); ?></span></div>
            <div class="p-2 border-b border-gray-700 flex justify-between"><span>Role</span><span><?php echo htmlspecialchars($user_info['role']); ?></span></div>
            <div class="p-2 border-b border-gray-700 flex justify-between"><span>Whitelist</span><span><?php echo $user_info['whitelisted'] ?? 'Puudub'; ?></span></div>
          </div>
        </div>
      </div>
    </div>

  <div x-show="settingsOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-gray-800 rounded p-6 w-96">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold">Kasutaja seaded</h3>
        <button @click="settingsOpen=false">&times;</button>
      </div>
      <div class="flex flex-col gap-3">
        <label>Kuvasuurendus
          <select class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            <option value="100">100%</option>
            <option value="90">90%</option>
            <option value="110">110%</option>
          </select>
      </div>
      <div class="flex justify-end gap-2 mt-4">
        <button @click="settingsOpen=false" class="px-4 py-2 bg-gray-700 rounded hover:bg-gray-600">Tühista</button>
        <button @click="alert('Seaded salvestatud')" class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-500">Salvesta</button>
      </div>
    </div>
  </div>

</body>
</html>
