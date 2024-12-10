<?php
include '../../database/koneksi.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    switch ($action) {
        case 'progress':
            $query = "UPDATE daftar_usulan SET status_permohonan = 'In Progress' WHERE id_usulan = '$id'";
            break;

        case 'approve':
            $query = "UPDATE daftar_usulan SET status_permohonan = 'Approved' WHERE id_usulan = '$id'";
            break;

        case 'reject':
            $query = "UPDATE daftar_usulan SET status_permohonan = 'Rejected' WHERE id_usulan = '$id'";
            break;

        default:
            die('Aksi tidak valid.');
    }

    if ($conn->query($query) === TRUE) {
        header("Location: /view/superadmin/daftar_usulan.php");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
} else {
    die('Parameter tidak ditemukan!');
}
?>
