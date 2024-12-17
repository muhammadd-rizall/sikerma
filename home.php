<?php
include 'database/koneksi.php';

// Query untuk menghitung jumlah MOU, MOA, dan IA
$query_mou = "SELECT COUNT(*) as jumlah FROM tb_mou_moa WHERE jenis_kerjasama = 'MOU'";
$query_moa = "SELECT COUNT(*) as jumlah FROM tb_mou_moa WHERE jenis_kerjasama = 'MOA'";
$query_ia  = "SELECT COUNT(*) as jumlah FROM tb_mou_moa WHERE jenis_kerjasama = 'IA'";

// Menjalankan query dan mengambil hasilnya
$result_mou = $conn->query($query_mou)->fetch_assoc();
$result_moa = $conn->query($query_moa)->fetch_assoc();
$result_ia  = $conn->query($query_ia)->fetch_assoc();

// Ambil hasil jumlah untuk masing-masing
$jumlah_mou = $result_mou['jumlah'] ?? 0;
$jumlah_moa = $result_moa['jumlah'] ?? 0;
$jumlah_ia  = $result_ia['jumlah'] ?? 0;

// Query untuk jumlah per tahun berdasarkan jenis dokumen
$query_year = "SELECT YEAR(STR_TO_DATE(awal_kerjasama, '%d-%m-%Y')) AS Tahun, jenis_kerjasama, COUNT(*) AS jumlah 
               FROM tb_mou_moa 
               GROUP BY YEAR(STR_TO_DATE(awal_kerjasama, '%d-%m-%Y')), jenis_kerjasama 
               ORDER BY YEAR(STR_TO_DATE(awal_kerjasama, '%d-%m-%Y')) ASC";

// Menjalankan query dan mengambil hasilnya
$result_year = $conn->query($query_year);

// Menyiapkan data untuk chart per tahun
$years = [];
$mou_per_year = [];
$moa_per_year = [];
$ia_per_year = [];

// Mengambil data dari hasil query dan mengelompokkan berdasarkan jenis dokumen per tahun
while ($row = $result_year->fetch_assoc()) {
    if ($row['jenis_kerjasama'] == 'MOU') {
        $mou_per_year[$row['Tahun']] = $row['jumlah'];
    } elseif ($row['jenis_kerjasama'] == 'MOA') {
        $moa_per_year[$row['Tahun']] = $row['jumlah'];
    } elseif ($row['jenis_kerjasama'] == 'IA') {
        $ia_per_year[$row['Tahun']] = $row['jumlah'];
    }
    $years[] = $row['Tahun'];
}

// Menghapus duplikat tahun
$years = array_values(array_unique($years)); 

// Pastikan setiap tahun ada dalam setiap kategori, jika tidak ada beri nilai 0
foreach ($years as $year) {
    $mou_per_year[$year] = $mou_per_year[$year] ?? 0;
    $moa_per_year[$year] = $moa_per_year[$year] ?? 0;
    $ia_per_year[$year] = $ia_per_year[$year] ?? 0;
}

// Debugging: Cek apakah data tahun dan jumlah per tahun sudah benar
// echo '<pre>';
//  var_dump($years);          // Menampilkan tahun-tahun yang diambil
// var_dump($mou_per_year);   // Menampilkan data MOU per tahun
// var_dump($moa_per_year);   // Menampilkan data MOA per tahun
// var_dump($ia_per_year);    // Menampilkan data IA per tahun
// echo '</pre>';
// exit;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 50px;
        }
        .card {
            background-color: #0e2c4b;
            color: white;
            text-align: center;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            flex: 1;
            box-sizing: border-box;
        }
        .container-chart {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 30px;
        }
        .chart-container {
            flex: 0.5;
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 500px;
            max-height: 400px;
        }
        canvas {
            width: 100% !important;
            height: 100% !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h3>MOU</h3>
            <p>Memorandum of Understanding</p>
            <div class="number"><?php echo $jumlah_mou; ?></div>
        </div>
        <div class="card">
            <h3>MOA</h3>
            <p>Memorandum of Agreements</p>
            <div class="number"><?php echo $jumlah_moa; ?></div>
        </div>
        <div class="card">
            <h3>IA</h3>
            <p>Implementation Agreement</p>
            <div class="number"><?php echo $jumlah_ia; ?></div>
        </div>
    </div>

    <!-- Container untuk Chart Sejajar -->
    <div class="container-chart">
        <div class="chart-container">
            <canvas id="chartTotal"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="chartPerYear"></canvas>
        </div>
    </div>

    <script>
        const jumlahMOU = <?php echo $jumlah_mou; ?>;
        const jumlahMOA = <?php echo $jumlah_moa; ?>;
        const jumlahIA = <?php echo $jumlah_ia; ?>;

        const years = <?php echo json_encode($years); ?>;
        const mouPerYear = <?php echo json_encode($mou_per_year); ?>;
        const moaPerYear = <?php echo json_encode($moa_per_year); ?>;
        const iaPerYear = <?php echo json_encode($ia_per_year); ?>;

        // Pie Chart Total MOU, MOA, IA
        new Chart(document.getElementById('chartTotal'), {
            type: 'doughnut',
            data: {
                labels: ['MOU', 'MOA', 'IA'],
                datasets: [{
                    data: [jumlahMOU, jumlahMOA, jumlahIA],
                    backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(75, 192, 192, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Line Chart Data per Tahun
        new Chart(document.getElementById('chartPerYear'), {
            type: 'bar',
            data: {
                labels: years,
                datasets: [
                    {
                        label: 'MOU',
                        data: years.map(year => mouPerYear[year] || 0),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    },
                    {
                        label: 'MOA',
                        data: years.map(year => moaPerYear[year] || 0),
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    },
                    {
                        label: 'IA',
                        data: years.map(year => iaPerYear[year] || 0),
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>
