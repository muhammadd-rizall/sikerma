<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../public/assets/css/layout.css">
    
    <title>Document</title>
</head>
<body>
   
    <!-- navbar -->
            <header class="header-area overlay">
            <nav class="navbar navbar-expand-md navbar-dark">
                <div class="container">
                    <a href="#" class="navbar-brand">Sikerma PNP</a>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                        <div class="menu-icon-bar"></div>
                        <div class="menu-icon-bar"></div>
                        <div class="menu-icon-bar"></div>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="main-nav">
                        <ul class="navbar-nav ms-auto">
                            <li><a href="#" class="nav-item nav-link active">Stastik</a></li>
                            <li><a href="#" class="nav-item nav-link">KerjaSama</a></li>
                            <li><a href="#" class="nav-item nav-link">Contact</a></li>
                            <li><a href="#" class="nav-item nav-link">From Pengajuan</a></li>
                            <li><a href="#" class="nav-item nav-link">Login</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="banner">
                <div class="container">
                    <img src="../../public/assets/img/pnp.png" alt="pnp" class="logopoli">
                    <h1>Sistem Informasi Kerjasama</h1>
                    <h1>Politeknik Negeri Padang</h1>
                    <a href="#content" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
                </div>
            </div>
        </header>
    <main>

    <?php
include '../../database/koneksi.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) :
case "list": 
    // Query untuk mengambil data dari tabel `usulan_kerjasama`
    $sql = "SELECT * FROM tb_usulan_kerjasama ORDER BY id_usulan DESC";
    $result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2>Daftar Dokumen Kerja Sama Politeknik Negeri Padang</h2>
    <table id="daftar-usulan" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Mitra</th>
                <th>Jenis Kerjasama</th>
                <th>Judul Kerjasama</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1;
                while ($landingPage = $result->fetch_assoc()) {
                    // Validasi setiap array key sebelum ditampilkan
                    $namaMitra = $landingPage['Nama Mitra'] ?? '-';
                    $jenisKerjasama = $landingPage['Jenis Kerjasama'] ?? '-';
                    $judulKerjasama = $landingPage['Judul Kerjasama'] ?? '-';
                    $tanggalAwal = $landingPage['Tanggal Awal'] ?? '-';
                    $tanggalAkhir = $landingPage['Tanggal Akhir'] ?? '-';
                    $status = $landingPage['Status'] ?? '-';
                    $detail = $landingPage['Detail'] ?? '-';

                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$namaMitra}</td>
                            <td>{$jenisKerjasama}</td>
                            <td>{$judulKerjasama}</td>
                            <td>{$tanggalAwal}</td>
                            <td>{$tanggalAkhir}</td>
                            <td>{$status}</td>
                            <td>{$detail}</td>
                        </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='8' style='text-align: center;'>Tidak ada data.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
break;
endswitch;
?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
