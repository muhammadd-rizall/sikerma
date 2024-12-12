<?php
include "../../database/koneksi.php"; // Sesuaikan path ke file koneksi

// Ambil parameter dari URL
$action = isset($_GET['action']) ? $_GET['action'] : '';
$id_usulan = isset($_GET['id_progres']) ? $_GET['id_progres'] : (isset($_GET['id_reject']) ? $_GET['id_reject'] : (isset($_GET['id_approve']) ? $_GET['id_approve'] : ''));

// Fungsi untuk memperbarui status berdasarkan aksi
function updateStatus($conn, $id, $status) {
    $sql = "UPDATE tb_usulan_kerjasama SET status_permohonan = ? WHERE id_usulan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

switch ($action) {
    case 'progress':
        if (updateStatus($conn, $id_usulan, 'In Progress')) {
            echo "<script>alert('Status berhasil diperbarui ke In Progress'); window.location='../../../index.php?p=daftarUsulan';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui status'); window.history.back();</script>";
        }
        break;

    case 'approve':
        if (updateStatus($conn, $id_usulan, 'Approved')) {
            echo "<script>alert('Status berhasil diperbarui ke Approved'); window.location='../../../index.php?p=daftarUsulan';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui status'); window.history.back();</script>";
        }
        break;

    case 'reject':
        if (updateStatus($conn, $id_usulan, 'Rejected')) {
            echo "<script>alert('Status berhasil diperbarui ke Rejected'); window.location='../../../index.php?p=daftarUsulan';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui status'); window.history.back();</script>";
        }
        break;

    default:
        echo "Aksi tidak valid.";
        break;
}

// Penghapusan data
if (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
    // Cek apakah parameter id_hapus ada
    if (isset($_GET['id_hapus']) && !empty($_GET['id_hapus'])) {
        $id_hapus = $_GET['id_hapus'];

        // Mengecek apakah ID ada dalam database
        $query = "SELECT id_usulan FROM tb_usulan_kerjasama WHERE id_usulan = '$id_hapus'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            echo "ID tidak ditemukan.";
            exit;
        }

        // Melakukan penghapusan data
        $hapus = mysqli_query($conn, "DELETE FROM tb_usulan_kerjasama WHERE id_usulan = '$id_hapus'");

        if ($hapus) {
            echo "<script>alert('Berhasil menghapus data');</script>";
            echo  "<script>window.location='../../../index.php?p=daftarUsulan'</script>";
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    } else {
        echo "ID tidak valid.";
    }
}
?>
