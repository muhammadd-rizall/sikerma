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
                    <a href="../auth/login.php" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
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
    $sql = "SELECT * FROM tb_mou_moa Join tb_mitra JOIN tb_kegiatan_kerjasama Where tb_mou_moa.id_mitra = tb_mitra.id_mitra AND tb_mou_moa.id_mou_moa = tb_kegiatan_kerjasama.id_mou_moa  ORDER BY tb_mou_moa.id_mou_moa DESC";
    $result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2>Daftar Dokumen Kerja Sama Politeknik Negeri Padang</h2>
    <table id="daftar-usulan" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Instansi</th>
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
                    $namaMitra = $landingPage['nama_instansi'] ?? '-';
                    $jenisKerjasama = $landingPage['jenis_kerjasama'] ?? '-';
                    $judulKerjasama = $landingPage['topik_kerjasama'] ?? '-';
                    $tanggalAwal = $landingPage['awal_kerjasama'] ?? '-';
                    $tanggalAkhir = $landingPage['akhir_kerjasama'] ?? '-';
                    $status = $landingPage['keterangan'] ?? '-';
                    $detail = $landingPage['kegiatan'] ?? '-';

                    echo "<tr>
                    <td>{$no}</td>
                    <td>{$namaMitra}</td>
                    <td>{$jenisKerjasama}</td>
                    <td>{$judulKerjasama}</td>
                    <td>{$tanggalAwal}</td>
                    <td>{$tanggalAkhir}</td>
                    <td>{$status}</td>
                    <td>
                        <button type='button' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#detailModal{$landingPage['id_mou_moa']}'>
                            Detail
                        </button>
                    </td>
                </tr>";

            // Modal untuk detail
            echo "
            <div class='modal fade' id='detailModal{$landingPage['id_mou_moa']}' tabindex='-1' aria-labelledby='detailModalLabel' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered modal-dialog-scrollable'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='detailModalLabel'>Detail Kerjasama</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <p><strong>Nama Instansi:</strong> {$namaMitra}</p>
                            <p><strong>Status:</strong> {$status}</p>
                            <p><strong>Kegiatan:</strong> {$landingPage['kegiatan']}</p>
                            <p><strong>Deskripsi Kegiatan:</strong> {$landingPage['deskripsi_kegiatan']}</p>
                            <p><strong>Dokumentasi:</strong> {$landingPage['dokumentasi']}</p>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Tutup</button>
                        </div>
                    </div>
                </div>
            </div>";
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
