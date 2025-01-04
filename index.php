<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: view/general/landing_page.php");
  exit;
}
$level = $_SESSION['level_user'];
?>

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
  <title>Dashboard SIMKERMA</title>
  <link rel="stylesheet" href="public/assets/css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>


  <style>


  </style>
</head>

<body>
  <div class="sidebar" id="sidebar">
    <div class="logo d-flex align-items-center">
      <img src="public/assets/img/pnp.png" alt="Logo" class="logo-img">
      <div class="logo-text ms-2">
        <h3>SIMKERMA</h3>
        <p>Sistem Manajemen Kerjasama</p>
      </div>
    </div>
    <hr style="border-color: rgba(255, 255, 255, 3.2);">

    <!-- Menu Items -->
    <a href="index.php?p=home" class="menu-item text-white d-flex align-items-center mb-2">
      <i class="fas fa-home me-2"></i> <span class="menu-text">Home</span>
    </a>


    <?php
    if ($level == 'superadmin' || $level == 'admin'):
      ?>

      <!-- menu daftar mitra -->
      <a href="index.php?p=dataMitra" class="menu-item text-white d-flex align-items-center mb-2">
        <i class="fa fa-handshake"></i> <span class="menu-text">Data Mitra</span>
      </a>

      <!-- menu data mouo moa -->
      <a href="index.php?p=dataMouMoa" class="menu-item text-white d-flex align-items-center mb-2">
        <i class="bi bi-file-earmark-fill"></i> <span class="menu-text">Data Mou/Moa</span>
      </a>



      <!-- menu data kegiatan -->
      <a href="index.php?p=dataKegiatan" class="menu-item text-white d-flex align-items-center mb-2">
        <i class="fa fa-clipboard-list"></i> <span class="menu-text">Data Kegiatan</span>
      </a>

      <!-- menu daftar usulan kerjasama -->
      <a href="index.php?p=daftarUsulan" class="menu-item text-white d-flex align-items-center mb-2">
        <i class="fa fa-paper-plane"></i> <span class="menu-text">Daftar Usulan Kerja Sama</span>
      </a>

      <?php
    endif;
    ?>


    <?php
    if ($level == 'mitra'):
      ?>
      <!-- form usulan kerjasama -->
      <a href="index.php?p=formUsulan" class="menu-item text-white d-flex align-items-center mb-4">
        <i class="fas fa-file-alt me-2"></i> <span class="menu-text">Pengajuan Kerja Sama</span>
      </a>

      <!-- proses usulan -->
      <a href="index.php?p=prosesUsulan" class="menu-item text-white d-flex align-items-center mb-4">
        <i class="fas fa-file-alt me-2"></i> <span class="menu-text">Proses Usulan</span>
      </a>

      <?php
    endif;
    ?>


    <?php
    if ($level == 'superadmin'):
      ?>
      <a href="index.php?p=user" class="menu-item text-white d-flex align-items-center mb-4">
        <i class="fa fa-id-badge"></i> <span class="menu-text">Tabel User</span>
      </a>

      <?php
    endif;
    ?>


    <?php
    if ($level == 'jurusan'):
      ?>
      <a href="index.php?p=daftarMitra" class="menu-item text-white d-flex align-items-center mb-4">
        <i class="fa fa-user-tie"></i> <span class="menu-text">Daftar Mitrar</span>
      </a>

      <?php
    endif;
    ?>

    <hr style="border-color: rgba(255, 255, 255, 5.2); margin-top: 200px;">

    <a href="#" class="menu-item text-white d-flex align-items-center mb-2 " onclick="openPopup()">
      <i class="fas fa-phone-alt me-2"></i> <span class="menu-text">Contact Us</span>
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
            <span class="nav-link disabled fw-bold" style="padding-right: 15px;"><?= $_SESSION['user'] ?></span>

          </div>
          <!-- Logout Icon -->
          <a href="view/auth/logout.php" class="btn btn-outline-danger btn-sm">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>
      </div>
    </nav>

    <div class="container">
      <?php
      if ($level == 'superadmin') {
        $page = isset($_GET['p']) ? $_GET['p'] : "home";
        if ($page == "home")
          include "home.php";
        if ($page == "dataMouMoa")
          include "view/superadmin/data_mou_moa.php";
        if ($page == "dataMitra")
          include "view/superadmin/data_mitra.php";
        if ($page == "dataKegiatan")
          include "view/superadmin/data_kegiatan.php";
        if ($page == "formUsulan")
          include "view/mitra/form_pengajuan.php";
        if ($page == "daftarUsulan")
          include "view/superadmin/daftar_usulan.php";
        if ($page == "user")
          include "view/superadmin/create_acount.php";
      } elseif ($_SESSION['level_user'] == 'admin') {
        if ($page == "home")
          include "home.php";
        if ($page == "dataMouMoa")
          include "view/superadmin/data_mou_moa.php";
        if ($page == "dataMitra")
          include "view/superadmin/data_mitra.php";
        if ($page == "dataKegiatan")
          include "view/superadmin/data_kegiatan.php";
        if ($page == "daftarUsulan")
          include "view/superadmin/daftar_usulan.php";

      } elseif ($level == 'jurusan') {
        $page = isset($_GET['p']) ? $_GET['p'] : "home";
        if ($page == "home")
          include "home.php";
        if ($page == "dataMouMoa")
          include "view/superadmin/data_mou_moa.php";
        if ($page == "daftarMitra")
          include "view/jurusan/daftar_mitra.php";

      } elseif ($level == 'mitra') {
        $page = isset($_GET['p']) ? $_GET['p'] : "home";
        if ($page == "home")
          include "home.php";
        if ($page == "formUsulan")
          include "view/mitra/form_pengajuan.php";
        if ($page == "prosesUsulan")
          include "view/mitra/proses_usulan.php";

      }
      ?>
    </div>
  </div>




  <script>
    // JavaScript untuk toggle sidebar
    // Ambil elemen sidebar, tombol toggle, dan konten utama
    const toggleButton = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    // Tambahkan event listener pada tombol toggle
    toggleButton.addEventListener('click', () => {
      // Toggle class 'hidden' untuk menampilkan atau menyembunyikan sidebar
      sidebar.classList.toggle('hidden');

      // Sesuaikan margin konten utama
      if (sidebar.classList.contains('hidden')) {
        mainContent.style.marginLeft = '0'; // Sidebar disembunyikan
      } else {
        mainContent.style.marginLeft = '250px'; // Sidebar terlihat
      }
    });



  </script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/vfs_fonts.min.js"></script>



  <script>
    $(document).ready(function () {
      // Inisialisasi DataTable pada tabel daftar usulan
      $('#daftar-usulan').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true  
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      // Inisialisasi DataTable pada tabel daftar usulan
      $('#tabel-mou-moa').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      // Inisialisasi DataTable pada tabel daftar usulan
      $('#tabel-kegiatan').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      // Inisialisasi DataTable pada tabel daftar usulan
      $('#tabel-mitra').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      // Inisialisasi DataTable pada tabel daftar usulan
      $('#daftar-dokumen').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      // Inisialisasi DataTable pada tabel daftar usulan
      $('#daftar-mitra').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      // Inisialisasi DataTable pada tabel daftar usulan
      $('#tabel-user').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
    
      });
    });
  </script>
  <!-- Popup -->
  <div class="popup-overlay" id="popupKontak">
    <div class="popup-content">
      <button class="popup-close" onclick="closePopup()">×</button>
      <h3>Kontak Kami</h3>
      <p><strong>Email:</strong> <a href="mailto:contact@pnp.ac.id">contact@pnp.ac.id</a></p>
      <p><strong>Telepon:</strong> (0751) 123456</p>
      <p><strong>Alamat:</strong> Jl. Kampus Limau Manis, Padang</p>
      <p><strong>Website:</strong> <a href="https://www.pnp.ac.id/">www.pnp.id</a></p>
      <p><strong>Instagram:</strong>
        <a href="https://www.instagram.com/politekniknegeripadang_pnp/?hl=id" target="_blank">@pnp_official</a>
      </p>
    </div>
  </div>
  <script>
    function openPopup() {
      document.getElementById('popupKontak').style.display = 'block';
    }

    function closePopup() {
      document.getElementById('popupKontak').style.display = 'none';
    }

  </script>



</body>

</html>