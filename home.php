<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grafik Statistik Kerjasama</title>
  <!-- Tambahkan Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="container my-5">
    <h1 class="text-center mb-4">Statistik Kerjasama</h1>
    <div class="row justify-content-center">
      <!-- Card untuk grafik -->
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">MoA</h5>
            <canvas id="grafikMoA" width="400" height="400"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">MoU</h5>
            <canvas id="grafikMoU" width="400" height="400"></canvas>
          </div>
        </div>
      </div>
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

  <!-- PHP untuk mendapatkan data dari database -->
  <?php
  include "database/koneksi.php";

  // Query untuk mengambil data jumlah berdasarkan jenis kerjasama
  $sql = "SELECT mou_moa.jenis_kerjasama, 
       CASE  
           WHEN mitra.negara = 'Indonesia' THEN 'Nasional' 
           ELSE 'Internasional' 
       END AS kategori,
       COUNT(*) AS jumlah 
FROM tb_mou_moa AS mou_moa 
JOIN tb_mitra AS mitra ON mou_moa.id_mitra = mitra.id_mitra 
GROUP BY mou_moa.jenis_kerjasama, kategori;
";
  $query = mysqli_query($conn, $sql);

  // Menyiapkan array untuk data
  $data = [
     'MoU' => ['Nasional' => 0, 'Internasional' => 0],
    'MoA' => ['Nasional' => 0, 'Internasional' => 0],
    'IA' => ['Nasional' => 0, 'Internasional' => 0],
  ];

  // Mengisi array dengan hasil query
  while($row = mysqli_fetch_array($query)){
    $jenis = $row['jenis_kerjasama'];
    $kategori = $row['kategori'];
    $data[$jenis][$kategori] = (int)$row['jumlah'];
  }

  // Encode data ke format JSON untuk digunakan di JavaScript
  $data_json = json_encode($data);
  ?>

  <!-- Script untuk membuat grafik -->
  <script>
    // Ambil data dari PHP
    const data = <?php echo $data_json; ?>;

    // Data untuk setiap jenis kerjasama
    const labels = Object.keys(data);
    const values = Object.values(data);

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
    function createChart(ctxId, chartType) {
      const ctx = document.getElementById(ctxId).getContext('2d');
      new Chart(ctx, {
        type: chartType,
        data: {
          labels: labels,
          datasets: [{
            data: values,
            backgroundColor: colors,
            borderColor: borderColors,
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
    createChart('grafikMoA', 'doughnut');
    createChart('grafikMoU', 'pie');
    createChart('grafikIA', 'bar');
  </script>
</body>
</html>
