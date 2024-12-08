<?php
    include "../../database/koneksi.php";


        // Cek apakah form sudah disubmit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama_instansi = $_POST['nama_instansi'];
        $nama_penjabat = $_POST['nama_penjabat'];
        $nama_jabatan = $_POST['nama_jabatan'];
        $nama_kontak_person = $_POST['nama_kontak_person'];
        $nomor_kontak = $_POST['nomor_kontak'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $status_permohonan = "Pending"; // Status default

        // Proses upload file dokumen
        $dokumen_usulan = $_FILES['dokumen_usulan']['name'];
        $target_dir = "uploads/documents/";
        $target_file = $target_dir . basename($dokumen_usulan);
        move_uploaded_file($_FILES['dokumen_usulan']['tmp_name'], $target_file);

        // Query untuk menyimpan data ke database
        $sql = "INSERT INTO daftar_usulan (nama_instansi, nama_penjabat, nama_jabatan, nama_kontak_person, nomor_kontak, email, alamat, dokumen_usulan, status_permohonan)
                VALUES ('$nama_instansi', '$nama_penjabat', '$nama_jabatan', '$nama_kontak_person', '$nomor_kontak', '$email', '$alamat', '$dokumen_usulan', '$status_permohonan')";

        if ($conn->query($sql) === TRUE) {
            // Redirect ke halaman daftar_usulan.php
            header("Location: daftar_usulan.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

?>