<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../public/assets/css/layout.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    
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
        switch ($aksi):
        case "list": 
            try {
                // Query untuk mengambil data dari tabel dengan JOIN yang benar
                $sql = "SELECT 
            tb_mitra.nama_instansi,
            tb_mou_moa.jenis_kerjasama,
            tb_mou_moa.topik_kerjasama,
            tb_mou_moa.awal_kerjasama,
            tb_mou_moa.akhir_kerjasama,
            tb_mou_moa.keterangan,
            tb_kegiatan_kerjasama.kegiatan,
            tb_kegiatan_kerjasama.deskripsi_kegiatan,
            tb_kegiatan_kerjasama.dokumentasi
        FROM 
            tb_mou_moa
        JOIN 
            tb_mitra ON tb_mou_moa.id_mitra = tb_mitra.id_mitra
        LEFT JOIN 
            tb_kegiatan_kerjasama ON tb_mou_moa.id_mou_moa = tb_kegiatan_kerjasama.id_mou_moa
        ORDER BY 
            tb_mou_moa.id_mou_moa asc ";



                
                $result = $conn->query($sql);

                if (!$result) {
                    throw new Exception("Error pada query: " . $conn->error);
                }
            } catch (Exception $e) {
                die("Terjadi kesalahan: " . $e->getMessage());
            }
    ?>

    <div class="container mt-5">
        <h2>Daftar Dokumen Kerja Sama Politeknik Negeri Padang</h2>
        <table id="dokumen-daftar" class="table table-bordered table-striped">
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
                        $idMouMoa = $landingPage['id_mou_moa'] ?? '-';
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
                                <button type='button' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#detailModal{$idMouMoa}'>
                                    Detail
                                </button>
                            </td>
                        </tr>";

                        // Modal untuk detail
                        echo "
                        <div class='modal fade' id='detailModal{$idMouMoa}' tabindex='-1' aria-labelledby='detailModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered modal-dialog-scrollable'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='detailModalLabel'>Detail Kerjasama</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <p><strong>Nama Instansi:</strong> {$namaMitra}</p>
                                        <p><strong>Nama Jenis Kerjasama:</strong> {$jenisKerjasama}</p>
                                        <p><strong>Nama Judul Kerjasama:</strong> {$judulKerjasama}</p>
                                        <p><strong>Status:</strong> {$status}</p>
                                        <p><strong>Kegiatan:</strong> {$detail}</p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/vfs_fonts.min.js"></script>

    <script>
    $(document).ready(function () {
        // Inisialisasi DataTable pada tabel daftar usulan
        $('#dokumen-daftar').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });
    });
</script>
</body>
</html>
