<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.all.min.js"></script>

<script>
    // Function to show modal using SweetAlert2
    const showModal = (message, redirectUrl = '') => {
        Swal.fire({
            icon: 'success',
            title: 'Pengajuan Berhasil!',
            text: message,
            timer: 3000,
            showConfirmButton: false,
            willClose: () => {
                if (redirectUrl) {
                    window.location.href = redirectUrl;
                }
            }
        });
    };

    const showErrorModal = (message) => {
        Swal.fire({
            icon: 'error',
            title: 'Pengajuan Gagal!',
            text: message,
            confirmButtonText: 'Tutup'
        }).then(() => {
            window.history.back(); // Go back to the previous page
        });
    };
</script>

<?php
include "../../database/koneksi.php";

session_start();
$user_id = $_SESSION['id_user'];

// Check if any form field is empty
if (empty($_POST['nama_instansi']) || empty($_POST['nama_penjabat']) || empty($_POST['nama_jabatan']) || empty($_POST['nama_kontak_person']) || empty($_POST['nomor_kontak']) || empty($_POST['email']) || empty($_POST['alamat'])) {
    echo "
    <script>
        showErrorModal('Harap isi semua data yang diperlukan sebelum mengajukan.');
    </script>";
    exit; 
}

// Get form data
$nama_instansi = $_POST['nama_instansi'];
$nama_penjabat = $_POST['nama_penjabat'];
$nama_jabatan = $_POST['nama_jabatan'];
$nama_kontak_person = $_POST['nama_kontak_person'];
$nomor_kontak = $_POST['nomor_kontak'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$status_permohonan = "Pending";

// Process file upload
$dokumen_usulan = $_FILES['dokumen_usulan']['name'];
$target_dir = __DIR__ . "/../../upload/documents/";
$target_file = $target_dir . basename($dokumen_usulan);

// Check file extension (only PDF allowed)
$file_ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if ($file_ext != 'pdf') {
    echo "
    <script>
        showErrorModal('Dokumen pengajuan harus diunggah dalam format PDF.');
    </script>";
    exit;
}

// Check if file is uploaded successfully
if (move_uploaded_file($_FILES['dokumen_usulan']['tmp_name'], $target_file)) {
    // Save data to the database
    $sql = "INSERT INTO tb_usulan_kerjasama (nama_instansi, nama_penjabat, nama_jabatan, nama_kontak_person, nomor_kontak, email, alamat, dokumen, status_permohonan, id_user) 
            VALUES ('$nama_instansi', '$nama_penjabat', '$nama_jabatan', '$nama_kontak_person', '$nomor_kontak', '$email', '$alamat', '$dokumen_usulan', '$status_permohonan', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
            showModal('Data Anda akan diproses dalam 7 hari kerja. Kami akan menghubungi Anda melalui email.', '/index.php');
        </script>";
    } else {
        echo "
        <script>
            showErrorModal('File berhasil diupload, tetapi data gagal disimpan ke database.');
        </script>";
    }
} else {
    // If file upload fails
    echo "
    <script>
        showErrorModal('Terjadi kesalahan saat mengunggah dokumen.');
    </script>";
}
?>

</body>
</html>
