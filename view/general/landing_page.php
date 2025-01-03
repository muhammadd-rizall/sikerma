<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <link rel="stylesheet" href="/public/assets/css/layout.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <title>simkerma PNP</title>

    <style>
    

    </style>
    
</head>
<body>
 <!-- Navbar -->
 <header class="header-area overlay">
 
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container">
                <a href="#" class="navbar-brand">Simkerma PNP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="navbar-nav ms-auto">
                        <li><a href="#chart-section" class="nav-item nav-link active">Statistik</a></li>
                        <li><a href="#table-section" class="nav-item nav-link">Kerja Sama</a></li>
                        <li><a href="#footer" class="nav-item nav-link">Kontak</a></li>
                        <li><a href="#" class="nav-item nav-link">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="banner text-center py-5 test">
            <img src="../../public/assets/img/pnp.png" alt="PNP Logo" class="logopoli">
            <h1>Sistem Informasi Kerjasama</h1>
            <h1>Politeknik Negeri Padang</h1>
            <a href="../auth/login.php" class="btn btn-primary mt-3"></i> Mulai Sekarang</a>
        </div>
    </header>

    <main class="container mt-5">
        <?php
        include '../../database/koneksi.php';

        // Query untuk menghitung jumlah MOU, MOA, dan IA
        $queries = [
            'MOU' => "SELECT COUNT(*) as jumlah FROM tb_mou_moa WHERE jenis_kerjasama = 'MOU'",
            'MOA' => "SELECT COUNT(*) as jumlah FROM tb_mou_moa WHERE jenis_kerjasama = 'MOA'",
            'IA'  => "SELECT COUNT(*) as jumlah FROM tb_mou_moa WHERE jenis_kerjasama = 'IA'",
        ];

        $dataCounts = [];
        foreach ($queries as $key => $query) {
            $result = $conn->query($query);
            $dataCounts[$key] = $result ? $result->fetch_assoc()['jumlah'] : 0;
        }

        // Query untuk jumlah per tahun berdasarkan jenis dokumen
        $query_year = "SELECT YEAR(awal_kerjasama) AS Tahun, jenis_kerjasama, COUNT(*) AS jumlah 
                        FROM tb_mou_moa 
                        GROUP BY Tahun, jenis_kerjasama 
                        ORDER BY Tahun ASC";

        $result_year = $conn->query($query_year);
        $years = [];
        $chartData = ['MOU' => [], 'MOA' => [], 'IA' => []];

        while ($row = $result_year->fetch_assoc()) {
            $year = $row['Tahun'];
            $type = $row['jenis_kerjasama'];
            $years[] = $year;
            $chartData[$type][$year] = $row['jumlah'];
        }

        $years = array_values(array_unique($years));
        foreach ($years as $year) {
            foreach (['MOU', 'MOA', 'IA'] as $type) {
                $chartData[$type][$year] = $chartData[$type][$year] ?? 0;
            }
        }
        ?>

        <!-- Kartu Statistik -->
        <div class="container d-flex flex-wrap justify-content-center" id="card-section">
            <?php foreach ($dataCounts as $key => $count): ?>
                <div class="card">
                    <h3><?php echo $key; ?></h3>
                    <p><?php echo $key === 'MOU' ? 'Memorandum of Understanding' : ($key === 'MOA' ? 'Memorandum of Agreement' : 'Implementation Agreement'); ?></p>
                    <div class="number"><?php echo $count; ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- chart -->
        <div class="container mt-5" id="chart-section">
            <h2 class="text-chart">Grafik Statistik Jumlah Kerjasama dan Data 5 Tahun Terakhir</h2>

            <div class="row d-flex align-items-center">
                <!-- Chart Bar di Kiri -->
                <div class="col-md-6">
                    <canvas id="chartTotal" style="width: 70%; height: ms-auto;"></canvas>
                </div>

                <!-- Chart Doughnut di Kanan -->
                <div class="col-md-6 d-flex justify-content-center">
                    <canvas id="chartPerYear" style="width: 100%; height: 350px;"></canvas>
                </div>
            </div>
        </div>


        <!-- Tabel Data Kerjasama -->
        <div class="container mt-5" id="table-section">
            <h2 class="text-chart">Daftar Dokumen Kerja Sama Politeknik Negeri Padang</h2>
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
                                tb_mou_moa.id_mou_moa ASC";

                    $result = $conn->query($sql);
                    $no = 1;
                    if ($result && $result->num_rows > 0):
                        while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nama_instansi'] ?? '-'; ?></td>
                                <td><?php echo $row['jenis_kerjasama'] ?? '-'; ?></td>
                                <td><?php echo $row['topik_kerjasama'] ?? '-'; ?></td>
                                <td><?php echo $row['awal_kerjasama'] ?? '-'; ?></td>
                                <td><?php echo $row['akhir_kerjasama'] ?? '-'; ?></td>
                                <td><?php echo $row['keterangan'] ?? '-'; ?></td>
                                <td>
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#detailModal<?php echo $no; ?>">
                                <i class="fa fa-circle-info fa-2x"></i>
                                </button>

                                </td>
                            </tr>
                            <div class="modal fade" id="detailModal<?php echo $no; ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Kerjasama</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Instansi:</strong> <?php echo $row['nama_instansi']; ?></p>
                                            <p><strong>Jenis Kerjasama:</strong> <?php echo $row['jenis_kerjasama']; ?></p>
                                            <p><strong>Judul Kerjasama:</strong> <?php echo $row['topik_kerjasama']; ?></p>
                                            <p><strong>Status:</strong> <?php echo $row['keterangan']; ?></p>
                                            <p><strong>Kegiatan:</strong> <?php echo $row['kegiatan']; ?></p>
                                            <p><strong>Deskripsi:</strong> <?php echo $row['deskripsi_kegiatan']; ?></p>
                                            <p><strong>Dokumentasi:</strong> <?php echo $row['dokumentasi']; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-tutup" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; 
                    else: ?>
                        <tr><td colspan="8" class="text-center">Tidak ada data.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <script>
    const dataCounts = <?php echo json_encode($dataCounts); ?>;
    const years = <?php echo json_encode($years); ?>;
    const chartData = <?php echo json_encode($chartData); ?>;

    // Data untuk grafik total
    const chartTotalCtx = document.getElementById('chartTotal').getContext('2d');

        new Chart(chartTotalCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(dataCounts),
                datasets: [{
                    label: 'Total Dokumen',
                    data: Object.values(dataCounts),
                    backgroundColor: ['#4e79a7', '#f28e2b', '#76b7b2'],
                }],
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false, 
                layout: {
                    padding: 10, 
                },
                plugins: {
                    legend: {
                        display: true, 
                        position: 'top', 
                    },
                    tooltip: {
                        enabled: true, 
                    },
                },
                elements: {
                    arc: {
                        borderWidth: 2, // Atur ketebalan garis batas
                    },
                },
            },
        });




    // Data untuk grafik per tahun
    const chartPerYearCtx = document.getElementById('chartPerYear').getContext('2d');

new Chart(chartPerYearCtx, {
    type: 'bar',
    data: {
        labels: years, // Label pada sumbu x (tahun)
        datasets: [
            {
                label: 'MOU',
                data: years.map(year => chartData.MOU[year]),
                borderColor: '#4e79a7',
                backgroundColor: '#4e79a7',
                borderWidth: 1, // Garis tepi bar
                barThickness: 35, // Lebar batang
            },
            {
                label: 'MOA',
                data: years.map(year => chartData.MOA[year]),
                borderColor: '#f28e2b',
                backgroundColor: '#f28e2b',
                borderWidth: 1,
                barThickness: 35,
            },
            {
                label: 'IA',
                data: years.map(year => chartData.IA[year]),
                borderColor: '#76b7b2',
                backgroundColor: '#76b7b2',
                borderWidth: 1,
                barThickness: 35,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Memungkinkan chart menyesuaikan tinggi/lebar
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    boxWidth: 15, // Ukuran kotak warna legenda
                    font: { size: 14 }, // Ukuran font legenda
                },
            },
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Tahun',
                    color: '#333',
                    font: { size: 14, weight: 'bold' },
                },
                ticks: { font: { size: 12 } },
            },
            y: {
                beginAtZero: true, // Memastikan skala dimulai dari 0
                title: {
                    display: true,
                    text: 'Jumlah Dokumen',
                    color: '#333',
                    font: { size: 14, weight: 'bold' },
                },
                ticks: { stepSize: 1, font: { size: 12 } },
            },
        },
        animation: {
            duration: 1500, // Durasi animasi saat render
            easing: 'easeOutBounce', // Jenis animasi
        },
    },
});



    // Inisialisasi DataTable
    $(document).ready(function() {
        $('#dokumen-daftar').DataTable();
    });
</script>

    </main>

    <footer class="bg-dark text-light py-3 mt-5"id="footer">
        <div class="container text-center">
            <p class="mb-1">&copy; <?php echo date("Y"); ?> Politeknik Negeri Padang</p>
            <p class="small">
                <a href="#" class="text-light text-decoration-none">Kebijakan Privasi</a> | 
                <a href="#" class="text-light text-decoration-none">Syarat & Ketentuan</a> | 
                <a href="#" class="text-light text-decoration-none"  onclick ="openPopup()">Hubungi Kami</a>
            </p>
            <div>
                <a href="https://www.instagram.com" target="_blank" class="text-light mx-2">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>
        </div>
    </footer>
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






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
