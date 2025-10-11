<?php
include 'auth.php';
checkAdmin();

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['flash_error'] = 'Vigane päring (CSRF).';
        header('Location: admin.php');
        exit;
    }

    $action = $_POST['action'] ?? '';
    $target_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($target_id <= 0) {
        $_SESSION['flash_error'] = 'Vale kasutaja id.';
        header('Location: admin.php');
        exit;
    }

    $stmt = $db->prepare("SELECT id, uid, name, is_admin FROM users WHERE id = ?");
    $stmt->execute([$target_id]);
    $target = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$target) {
        $_SESSION['flash_error'] = 'Kasutajat ei leitud.';
        header('Location: admin.php');
        exit;
    }

    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE is_admin = 1");
    $stmt->execute();
    $adminCount = (int)$stmt->fetchColumn();

    $current_uid = $_SESSION['user_id'];
    $isSelf = ($target['uid'] === $current_uid);

    if ($action === 'delete') {
        if ($isSelf) {
            $_SESSION['flash_error'] = 'Sa ei saa kustutada ennast.';
            header('Location: admin.php'); exit;
        }
        if ($target['is_admin'] && $adminCount <= 1) {
            $_SESSION['flash_error'] = 'Ei saa kustutada viimast admini.';
            header('Location: admin.php'); exit;
        }

        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$target_id]);

        $_SESSION['flash_success'] = 'Kasutaja kustutatud.';
        header('Location: admin.php'); exit;
    }

    if ($action === 'set_admin') {
        $set = isset($_POST['set']) ? (int)$_POST['set'] : 0;

        if ($isSelf && $set === 0) {
            $_SESSION['flash_error'] = 'Sa ei saa eemaldada end administ.';
            header('Location: admin.php'); exit;
        }

        if ($target['is_admin'] && $set === 0 && $adminCount <= 1) {
            $_SESSION['flash_error'] = 'Ei saa eemaldada viimast admini.';
            header('Location: admin.php'); exit;
        }

        $stmt = $db->prepare("UPDATE users SET is_admin = ? WHERE id = ?");
        $stmt->execute([$set, $target_id]);

        $_SESSION['flash_success'] = $set ? 'Kasutajale antud admin õigused.' : 'Admin õigused eemaldatud.';
        header('Location: admin.php'); exit;
    }

    if ($action === 'set_role') {
        $newrole = trim($_POST['role'] ?? '');
        if ($newrole === '') {
            $_SESSION['flash_error'] = 'Roll ei saa olla tühi.';
            header('Location: admin.php'); exit;
        }
        $stmt = $db->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$newrole, $target_id]);
        $_SESSION['flash_success'] = 'Roll uuendatud.';
        header('Location: admin.php'); exit;
    }

    $_SESSION['flash_error'] = 'Tundmatu toiming.';
    header('Location: admin.php'); exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $db->prepare("SELECT * FROM users WHERE uid = ?");
$stmt->execute([$user_id]);
$user_info = $stmt->fetch(PDO::FETCH_ASSOC);
$username = htmlspecialchars($user_info['name']);
$user_role = htmlspecialchars($user_info['role'] ?? 'Mängija');

$all_services = ['Konto', 'Steam', 'Discord', 'CFX.re', 'Keelustus'];

$stmt = $db->query("SELECT id, uid, name, email, role, is_admin, created_at FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

  <main class="ml-64 p-8">
    <h1 class="text-3xl font-bold mb-6">Admin Haldus</h1>
    <?php if ($flash_error): ?>
      <div class="mb-4 p-3 bg-red-600 text-white rounded"><?php echo htmlspecialchars($flash_error); ?></div>
    <?php endif; ?>
    <?php if ($flash_success): ?>
      <div class="mb-4 p-3 bg-green-600 text-white rounded"><?php echo htmlspecialchars($flash_success); ?></div>
    <?php endif; ?>

    <div class="bg-gray-800 p-6 rounded-xl shadow-lg">
      <h2 class="text-xl font-semibold mb-4">Registreeritud kasutajad</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="border-b border-gray-700">
              <th class="text-left py-2 px-3">ID</th>
              <th class="text-left py-2 px-3">Nimi</th>
              <th class="text-left py-2 px-3">Email</th>
              <th class="text-left py-2 px-3">Roll</th>
              <th class="text-left py-2 px-3">Admin</th>
              <th class="text-left py-2 px-3">Registreeritud</th>
              <th class="text-left py-2 px-3">Tegevused</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $u): ?>
              <tr class="border-b border-gray-800 hover:bg-gray-700">
                <td class="py-2 px-3"><?php echo $u['id']; ?></td>
                <td class="py-2 px-3"><?php echo htmlspecialchars($u['name']); ?></td>
                <td class="py-2 px-3"><?php echo htmlspecialchars($u['email']); ?></td>
                <td class="py-2 px-3">
                <form method="post" class="inline-flex items-center gap-2">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                    <input type="hidden" name="action" value="set_role">
                    <input type="text" name="role" value="<?php echo htmlspecialchars($u['role']); ?>" class="bg-gray-700 text-white p-1 rounded w-32" />
                    <button type="submit" class="ml-2 px-2 py-1 bg-blue-600 rounded hover:bg-blue-500 text-white">Salvesta</button>
                  </form>
                </td>
                <td class="py-2 px-3">
                  <?php if ($u['is_admin']): ?>
                    <span class="text-green-400 font-semibold">Jah</span>
                  <?php else: ?>
                    <span class="text-gray-400">Ei</span>
                  <?php endif; ?>
                </td>
                <td class="py-2 px-3 text-gray-400"><?php echo $u['created_at']; ?></td>
                <td class="py-2 px-3">
                <?php if ($u['uid'] !== $_SESSION['user_id']):?>
                    <form method="post" class="inline-block mr-2">
                      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                      <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                      <input type="hidden" name="action" value="set_admin">
                      <input type="hidden" name="set" value="<?php echo $u['is_admin'] ? 0 : 1; ?>">
                      <button type="submit" class="px-2 py-1 rounded <?php echo $u['is_admin'] ? 'bg-yellow-600 hover:bg-yellow-500' : 'bg-green-600 hover:bg-green-500'; ?>">
                        <?php echo $u['is_admin'] ? 'Eemalda admin' : 'Tee adminiks'; ?>
                      </button>
                    </form>
                  <?php else: ?>
                    <button class="px-2 py-1 rounded bg-gray-600" title="Sa ei saa muuta ennast">-</button>
                  <?php endif; ?>

                  <?php if ($u['uid'] !== $_SESSION['user_id']): ?>
                    <form method="post" class="inline-block" onsubmit="return confirm('Kas oled kindel, et soovid kasutaja kustutada?');">
                      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                      <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                      <input type="hidden" name="action" value="delete">
                      <button type="submit" class="px-2 py-1 rounded bg-red-600 hover:bg-red-500 text-white"><i class="fas fa-trash"></i></button>
                    </form>
                  <?php else: ?>
                    <button class="px-2 py-1 rounded bg-gray-600" title="Sa ei saa kustutada ennast">-</button>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>
</html>
