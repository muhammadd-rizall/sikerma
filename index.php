<?php
// Data simulasi
$mou_count = 12;
$moa_count = 8;
$ia_count = 5;
$statistik = [10, 20, 30, 40, 50, 60, 70];
$bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard SIKERMA</title>
  <link rel="stylesheet" href="public/assets/css/index.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>

  </style>
</head>
<body>
<div class="sidebar" id="sidebar">
  <div class="logo d-flex align-items-center">
    <img src="public/assets/img/pnp.png" alt="Logo" class="logo-img">
    <div class="logo-text ms-2">
      <h3>SIKERMA</h3>
      <p>Sistem Manajemen Kerjasama</p>
    </div>
  </div>
  <hr style="border-color: rgba(255, 255, 255, 3.2);">

  <!-- Menu Items -->
  <a href="index.php?p=home" class="menu-item text-white d-flex align-items-center mb-2">
    <i class="fas fa-home me-2"></i> <span class="menu-text">Home</span>
  </a>
  <a href="index.php?p=dataMouMoa" class="menu-item text-white d-flex align-items-center mb-2">
  <i class="bi bi-file-earmark-fill"></i> <span class="menu-text">Data Mou/Moa</span>
  </a>
  <a href="#" class="menu-item text-white d-flex align-items-center mb-2">
    <i class="fas fa-list me-2"></i> <span class="menu-text">Daftar Usulan Kerja Sama</span>
  </a>
  <a href="#" class="menu-item text-white d-flex align-items-center mb-4">
    <i class="fas fa-file-alt me-2"></i> <span class="menu-text">Pengajuan Kerja Sama</span>
  </a>

  <hr style="border-color: rgba(255, 255, 255, 5.2); margin-top: 200px;">

  <a href="#" class="menu-item text-white d-flex align-items-center mb-2">
    <i class="fas fa-envelope me-2"></i> <span class="menu-text">Message</span>
  </a>
  <a href="#" class="menu-item text-white d-flex align-items-center mb-2">
    <i class="fas fa-phone-alt me-2"></i> <span class="menu-text">Contact Us</span>
  </a>
  <a href="#" class="menu-item text-white d-flex align-items-center">
    <i class="fas fa-cog me-2"></i> <span class="menu-text">Settings</span>
  </a>
</div>

<!-- Main Content -->
<div class="content" id="mainContent">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <div class="d-flex align-items-center">
        <button class="btn-toggle-btn me-2" id="toggleSidebar">
          <i class="fas fa-bars"></i>
        </button>
        <h4 class="mb-0">Dashboard</h4>
      </div>
      <div class="d-flex align-items-center">
        <!-- Username with Icon -->
        <div class="me-3 d-flex align-items-center">
          <i class="fas fa-user-circle fs-4 me-2"></i> <!-- Font Awesome Icon -->
          <span>Username</span>
        </div>
        <!-- Logout Icon -->
        <a href="#" class="btn btn-outline-danger btn-sm">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </div>
  </nav>

  <div class="container">
        <?php
        $page = isset($_GET['p']) ? $_GET['p'] : "home";
        if ($page == "home") include "home.php";
        if ($page == "dataMouMoa") include "view/superadmin/data_mou_moa.php";
        if ($page == "prodi") include "prodi.php";
        if ($page == "dosen") include "dosen.php";
        if ($page == "matakuliah") include "matakuliah.php";
        ?>
    </div>
</div>


<script>
  // JavaScript untuk toggle sidebar
  document.getElementById('toggleSidebar').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('collapsed');
  });
</script>
</body>
</html>
