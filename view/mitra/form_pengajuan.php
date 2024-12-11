<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form Usulan</title>
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Form Pengajuan Kerjasama</h1>
            <form action="view/mitra/proses_pengajuan.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <!-- nama instansi -->
                <div class="form-group mb-3 mt-5">
                    <label>Nama Instansi:</label>
                    <input type="text" name="nama_instansi" class="form-control" placeholder="Masukkan nama instansi" required>
                </div>

                <!-- nama penjabat -->
                <div class="form-group mb-3">
                    <label>Nama Penjabat:</label>
                    <input type="text" name="nama_penjabat" class="form-control" placeholder="Masukkan nama penjabat" required>
                </div>

                <!-- nama jabatan -->
                <div class="form-group mb-3">
                    <label>Nama Jabatan:</label>
                    <input type="text" name="nama_jabatan" class="form-control" placeholder="Masukkan nama penjabat" required>
                </div>

                <!-- nama kontak person -->
                <div class="form-group mb-3">
                    <label>Nama Kontak Person:</label>
                    <input type="text" name="nama_kontak_person" class="form-control" placeholder="Masukkan nama kontak person" required>
                </div>

                    <!-- Nomor Kontak -->
                <div class="form-group mb-3">
                    <label>Nomor Kontak:</label>
                    <input type="tel" name="nomor_kontak" class="form-control" placeholder="Masukkan nomor kontak" required>
                </div>

                <!-- email -->
                <div class="form-group mb-3">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>

                <!-- alamat -->
                <div class="form-group mb-3">
                    <label>Alamat:</label>
                    <textarea name="alamat" class="form-control" placeholder="Masukkan alamat" required></textarea>
                </div>

                <!-- dokumen -->
                <div class="form-group mb-3">
                    <label>Dokumen (PDF):</label>
                    <input type="file" name="dokumen_usulan" class="form-control-file" accept=".pdf" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>

    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



