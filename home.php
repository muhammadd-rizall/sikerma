<?php
// Sertakan file koneksi database
include "database/koneksi.php";

// Cek koneksi database
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil jumlah berdasarkan jenis kerjasama
$sql = "SELECT jenis_kerjasama from tb_mou_moa";
$query = mysqli_query($conn, $sql);

// Menyiapkan array default
$data = [
    'MOA' => 0,
    'MOU' => 0,
    'IA' => 0
];

// Mengisi array dengan hasil query
if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
        $jenis = $row['jenis_kerjasama'];
        $jumlah = (int) $row['jumlah'];
        if (array_key_exists($jenis, $data)) {
            $data[$jenis] = $jumlah;
        }
    }
}



// Encode data ke format JSON
$data_json = json_encode($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grafik Statistik Kerjasama</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="container my-5">
    <h1 class="text-center mb-4">Statistik Kerjasama</h1>
    <div class="row justify-content-center">
      <!-- Card untuk grafik MoA -->
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">MoA</h5>
            <canvas id="grafikMoA" width="400" height="400"></canvas>
          </div>
        </div>
      </div>
      <!-- Card untuk grafik MoU -->
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">MoU</h5>
            <canvas id="grafikMoU" width="400" height="400"></canvas>
          </div>
        </div>
      </div>
      <!-- Card untuk grafik IA -->
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">IA</h5>
            <canvas id="grafikIA" width="400" height="400"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Debugging Data dari PHP -->
  <script>
    // Data dari PHP
    const data = <?php echo $data_json; ?>;
    console.log('Data dari PHP:', data);

    // Data untuk grafik
    const labels = Object.keys(data);
    const values = Object.values(data);

    console.log('Labels:', labels);
    console.log('Values:', values);

    // Warna untuk grafik
    const colors = [
      'rgba(255, 99, 132, 0.5)', // MoA
      'rgba(54, 162, 235, 0.5)', // MoU
      'rgba(255, 206, 86, 0.5)'  // IA
    ];

    const borderColors = [
      'rgba(255, 99, 132, 1)', // MoA
      'rgba(54, 162, 235, 1)', // MoU
      'rgba(255, 206, 86, 1)'  // IA
    ];

    // Fungsi untuk membuat grafik
    function createChart(ctxId, chartType, labelName) {
      const ctx = document.getElementById(ctxId).getContext('2d');
      new Chart(ctx, {
        type: chartType,
        data: {
          labels: [labelName],
          datasets: [{
            label: labelName,
            data: [data[labelName]],
            backgroundColor: colors[labels.indexOf(labelName)],
            borderColor: borderColors[labels.indexOf(labelName)],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: true,
              position: 'top'
            }
          }
        }
      });
    }

    // Membuat grafik MoA, MoU, dan IA
    createChart('grafikMoA', 'doughnut', 'MoA');
    createChart('grafikMoU', 'pie', 'MoU');
    createChart('grafikIA', 'bar', 'IA');
  </script>
</body>
</html>
