<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Fungsi untuk mengambil data berdasarkan id_usulan
function getUsulanDetails($conn, $id) {
    $sql = "SELECT * FROM tb_usulan_kerjasama WHERE id_usulan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc(); // Mengembalikan data sebagai array asosiatif
}

if (isset($_GET["id_usulan"]) && isset($_GET["status_permohonan"])) {
    $id_usulan = $_GET["id_usulan"];
    $status_permohonan = $_GET["status_permohonan"];
    
    // Pastikan koneksi database tersedia
    include "../../database/koneksi.php";
    
    // Ambil data usulan dari database
    $usulanDetails = getUsulanDetails($conn, $id_usulan);
    
    // Validasi hasil query
    if (!$usulanDetails) {
        echo "<script>alert('Data tidak ditemukan.'); window.history.back();</script>";
        exit;
    }
    
    $nama_instansi = $usulanDetails["nama_instansi"];
    $email = $usulanDetails["email"];
    $nama_jabatan = $usulanDetails['nama_jabatan']; // Pastikan kolom ini ada di tabel
    $nama_penjabat = $usulanDetails["nama_penjabat"];
    $nama_kontak_person = $usulanDetails["nama_kontak_person"];
    $nomor_kontak = $usulanDetails["nomor_kontak"];
    $alamat = $usulanDetails["alamat"];
    
    
    $mail = new PHPMailer(true);
    
    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'katsurazura66@gmail.com'; // Ganti dengan email Anda
        $mail->Password = 'wkyurvxcokwegokh'; // Ganti dengan App Password Gmail Anda
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Detail pengirim dan penerima
        $mail->setFrom('katsurazura66@gmail.com'); // Ganti dengan email pengirim Anda
        $mail->addAddress($email); // Email penerima

        // Konten email 
        $mail->isHTML(true);
        $mail->Subject = "Status Permohonan: $nama_instansi telah diproses";
        $mail->Body    = "Status permohonan Anda: <b>$status_permohonan</b><br>Nama Jabatan: <b>$nama_jabatan</b><br>Nama Kontak Person: <b>$nama_kontak_person</b><br>Nomor Kontak: <b>$nomor_kontak</b><br>Alamat: <b>$alamat</b>";

        // Kirim email
        $mail->send();

        echo "<script>alert('Email berhasil dikirim!'); window.location='../../../index.php?p=daftarUsulan';</script>";

    } catch (Exception $e) {
        echo "<script>alert('Email gagal dikirim: " . $mail->ErrorInfo . "'); history.back();</script>";
    }
}
?>
