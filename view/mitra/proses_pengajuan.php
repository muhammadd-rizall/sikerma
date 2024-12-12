<?php
include "../../database/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $nama_instansi = $_POST['nama_instansi'];
    $nama_penjabat = $_POST['nama_penjabat'];
    $nama_jabatan = $_POST['nama_jabatan'];
    $nama_kontak_person = $_POST['nama_kontak_person'];
    $nomor_kontak = $_POST['nomor_kontak'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $status_permohonan = "Pending";

    // Proses file upload
    $dokumen_usulan = $_FILES['dokumen_usulan']['name'];
    $target_dir = __DIR__ . "/../../upload/documents/";
    $target_file = $target_dir . basename($dokumen_usulan);
    if (move_uploaded_file($_FILES['dokumen_usulan']['tmp_name'], $target_file)) {
        // Simpan data ke database
        $sql = "INSERT INTO tb_usulan_kerjasama (nama_instansi, nama_penjabat, nama_jabatan, nama_kontak_person, nomor_kontak, email, alamat, dokumen, status_permohonan) 
                VALUES ('$nama_instansi', '$nama_penjabat', '$nama_jabatan', '$nama_kontak_person', '$nomor_kontak', '$email', '$alamat', '$dokumen_usulan', '$status_permohonan')";

            if ($conn->query($sql) === TRUE) {
                    // Jika berhasil
                    
                    echo" 
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Pengajuan Berhasil!',
                            text: 'Data Anda akan diproses dalam 7 hari kerja. Kami akan menghubungi Anda melalui email.',
                            timer: 3000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '../../index.php';
                        });
                    </script>";
                } else {
                    // Jika gagal menyimpan ke database
                    echo "
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Pengajuan Gagal!',
                            text: 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.'
                        }).then(() => {
                            window.location.href = '../../index.php';
                        });
                    </script>";
                    }

            }
    }
?>
