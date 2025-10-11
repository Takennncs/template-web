<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="flex-1 flex flex-col gap-2">
  <a href="dashboard.php" class="flex items-center gap-2 px-4 py-2 bg-gray-700 rounded">
    <i class="fas fa-home"></i> Avaleht
  </a>

  <?php if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
    <a href="admin.php" class="flex items-center gap-2 px-4 py-2 bg-gray-700 rounded hover:bg-gray-600">
      <i class="fas fa-tools"></i> Admin
    </a>
  <?php endif; ?>
</nav>

    <!-- Edasi tee ise nuub -->
