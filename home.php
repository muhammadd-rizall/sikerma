<?php

   

        include 'database/koneksi.php';

        // Query untuk menghitung jumlah MOU, MOA, dan IA
        $queries = [
            'MOU' => "SELECT COUNT(*) as jumlah FROM tb_mou_moa WHERE jenis_kerjasama = 'MOU'",
            'MOA' => "SELECT COUNT(*) as jumlah FROM tb_mou_moa WHERE jenis_kerjasama = 'MOA'",
            'IA' => "SELECT COUNT(*) as jumlah FROM tb_mou_moa WHERE jenis_kerjasama = 'IA'",
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


        // Query untuk daftar usulan yang masuk
        $news_baru = "SELECT COUNT(*) AS jumlah FROM tb_usulan_kerjasama";
        $result_news = $conn->query($news_baru);
        $row_news = $result_news->fetch_assoc();
        $jumlah_news_baru = $row_news['jumlah'];

        // Query untuk MOU/MOA yang akan berakhir (30 hari ke depan)
        $news_akan = "SELECT COUNT(*) AS jumlah FROM tb_mou_moa 
                    WHERE akhir_kerjasama BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)";
        $result_akan = $conn->query($news_akan);
        $row_akan = $result_akan->fetch_assoc();
        $jumlah_news_akan = $row_akan['jumlah'];

        // Query untuk MOU/MOA yang telah berakhir
        $news_telah = "SELECT COUNT(*) AS jumlah FROM tb_mou_moa 
                    WHERE akhir_kerjasama < CURDATE()";
        $result_telah = $conn->query($news_telah);
        $row_telah = $result_telah->fetch_assoc();
        $jumlah_news_telah = $row_telah['jumlah'];



        // Cek apakah user sudah login
        if (!isset($_SESSION['login'])) {
            header("Location: home.php");
            exit;
        }


?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik</title>
    <link rel="stylesheet" href="public/assets/css/styleH.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

    </style>
</head>

<body>

    <?php
    if ($level == 'jurusan' || $level == 'mitra'):
      ?>
        <!-- Kartu Statistik -->
        <div class=" d-flex flex-wrap justify-content-center" id="card-section">
            <?php foreach ($dataCounts as $key => $count): ?>
                <div class="card">
                    <h3><?php echo $key; ?></h3>
                    <p><?php echo $key === 'MOU' ? 'Memorandum of Understanding' : ($key === 'MOA' ? 'Memorandum of Agreement' : 'Implementation Agreement'); ?></p>
                    <div class="number"><?php echo $count; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif;?> 


    <?php
if ($level == 'superadmin' || $level == 'admin'):
?>

<div class="">
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="card text-center shadow-sm p-3">
                <h3 class="text-primary">Masuk</h3>
                <p> <?php echo $jumlah_news_baru; ?></p>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalMasuk">
                    <i class="fa fa-circle-info fa-2x"></i>
                </button>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card text-center shadow-sm p-3">
                <h3 class="text-warning">Akan Berakhir</h3>
                <p> <?php echo $jumlah_news_akan; ?></p>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalAkanBerakhir">
                    <i class="fa fa-circle-info fa-2x"></i>
                </button>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card text-center shadow-sm p-3">
                <h3 class="text-danger">Telah Berakhir</h3>
                <p> <?php echo $jumlah_news_telah; ?></p>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalTelahBerakhir">
                    <i class="fa fa-circle-info fa-2x"></i>
                </button>
            </div>
        </div>
    </div>
</div>



<!-- Modal untuk Data Masuk -->
<div class="modal fade" id="modalMasuk" tabindex="-1" aria-labelledby="modalMasukLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMasukLabel">Data Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Instansi</th>
                            <th>Nama Pemjabat</th>
                            <th>Nama Jabatan</th>
                            <th>Nama Kontak Person</th>
                            <th>Nomor Kontak </th>
                            <th>Email</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_masuk = "SELECT * FROM tb_usulan_kerjasama";
                        $result_masuk = $conn->query($query_masuk);
                        $no = 1;
                        while ($row = $result_masuk->fetch_assoc()) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama_instansi']}</td>
                                <td>{$row['nama_penjabat']}</td>
                                <td>{$row['nama_jabatan']}</td>
                                <td>{$row['nama_kontak_person']}</td>
                                <td>{$row['nomor_kontak']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['alamat']}</td>
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Data Akan Berakhir -->
<div class="modal fade" id="modalAkanBerakhir" tabindex="-1" aria-labelledby="modalAkanBerakhirLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAkanBerakhirLabel">Data Akan Berakhir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Instansi</th>
                            <th>Jenis Kerjasama</th>
                            <th>Judul Kerjasama</th>
                            <th>Awal Kerjasama</th>
                            <th>Akhir Kerjasama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_akan_berakhir = "SELECT tb_mitra.nama_instansi,tb_mou_moa.jenis_kerjasama,tb_mou_moa.topik_kerjasama,tb_mou_moa.awal_kerjasama,tb_mou_moa.akhir_kerjasama
                        FROM tb_mou_moa JOIN tb_mitra ON tb_mou_moa.id_mitra = tb_mitra.id_mitra
                        WHERE tb_mou_moa.akhir_kerjasama BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)";
                        $result_akan_berakhir = $conn->query($query_akan_berakhir);
                        $no = 1;
                        if ($result_akan_berakhir && $result_akan_berakhir->num_rows > 0):
                            while ($row = $result_akan_berakhir->fetch_assoc()) {
                                $awalKerjasama = $row['awal_kerjasama'];
                                $akhirKerjasama = $row['akhir_kerjasama'];
                                $today = date('Y-m-d');
                    
                                // Menentukan status aktif atau tidak aktif
                                if ($today >= $awalKerjasama && $today <= $akhirKerjasama) {
                                    $status = "Aktif";
                                } else {
                                    $status = "Tidak Aktif";
                                }

                                    $statusColor = ($status === "Aktif") ? "text-success" : "text-danger";
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama_instansi']}</td>
                                <td>{$row['jenis_kerjasama']}</td>
                                <td>{$row['topik_kerjasama']}</td>
                                <td>{$row['awal_kerjasama']}</td>
                                <td>{$row['akhir_kerjasama']}</td>
                                <td class='{$statusColor}'>{$status}</td>
                            </tr>";
                            $no++;
                        }
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Data Telah Berakhir -->
<div class="modal fade" id="modalTelahBerakhir" tabindex="-1" aria-labelledby="modalTelahBerakhirLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTelahBerakhirLabel">Data Telah Berakhir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>No</th>
                            <th>Nama Instansi</th>
                            <th>Jenis Kerjasama</th>
                            <th>Judul Kerjasama</th>
                            <th>Awal Kerjasama</th>
                            <th>Akhir Kerjasama</th>
                            <th>Status</th>                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_telah_berakhir = "SELECT tb_mitra.nama_instansi,tb_mou_moa.jenis_kerjasama,tb_mou_moa.topik_kerjasama,tb_mou_moa.awal_kerjasama,tb_mou_moa.akhir_kerjasama
                        FROM tb_mou_moa JOIN tb_mitra ON tb_mou_moa.id_mitra = tb_mitra.id_mitra
                        WHERE tb_mou_moa.akhir_kerjasama < CURDATE()";
                        $result_telah_berakhir = $conn->query($query_telah_berakhir);
                        $no = 1;
                        if ($result_telah_berakhir && $result_telah_berakhir->num_rows > 0):
                            while ($row = $result_telah_berakhir->fetch_assoc()) {
                                $awalKerjasama = $row['awal_kerjasama'];
                                $akhirKerjasama = $row['akhir_kerjasama'];
                                $today = date('Y-m-d');
                    
                                // Menentukan status aktif atau tidak aktif
                                if ($today >= $awalKerjasama && $today <= $akhirKerjasama) {
                                    $status = "Aktif";
                                } else {
                                    $status = "Tidak Aktif";
                                }

                                    $statusColor = ($status === "Aktif") ? "text-success" : "text-danger";
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama_instansi']}</td>
                                <td>{$row['jenis_kerjasama']}</td>
                                <td>{$row['topik_kerjasama']}</td>
                                <td>{$row['awal_kerjasama']}</td>
                                <td>{$row['akhir_kerjasama']}</td>
                                <td class='{$statusColor}'>{$status}</td>
                            </tr>";
                            $no++;
                        }
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>







    <!-- chart -->
    <div class="" id="chart-section">
        <h2 class="text-chart">Grafik Statistik Jumlah Kerjasama dan Data 5 Tahun Terakhir</h2>

        <div class="row d-flex align-items-center">
            <!-- Chart Bar di Kiri -->
            <div class="col-md-6">
                <canvas id="chartTotal" style="width: 100%; height: 300px;"></canvas>
            </div>

            <!-- Chart Doughnut di Kanan -->
            <div class="col-md-6 d-flex justify-content-center">
                <canvas id="chartPerYear" style="width: 100%; height: 300px;"></canvas>
            </div>
        </div>
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
            type: 'line',
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


    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




</body>

</html>