<?php
require '../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
include "../../database/koneksi.php";

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Ambil data dari database
if ($id) {
    $sql = "SELECT tb_mou_moa.no_mou_moa, tb_mitra.nama_instansi, tb_mou_moa.jenis_kerjasama, 
    tb_mou_moa.topik_kerjasama, tb_mou_moa.jangka_waktu, tb_mou_moa.awal_kerjasama, 
    tb_mou_moa.akhir_kerjasama, tb_mou_moa.jurusan_terkait, tb_mou_moa.keterangan
    FROM tb_mou_moa 
    JOIN tb_mitra ON tb_mou_moa.id_mitra = tb_mitra.id_mitra 
    WHERE tb_mou_moa.no_mou_moa = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // Konten HTML untuk PDF
        $html = '<h1>Detail Kerjasama</h1>';
        $html .= '<p><strong>No MOU/MOA:</strong> ' . htmlspecialchars($data['no_mou_moa']) . '</p>';
        $html .= '<p><strong>Nama Mitra:</strong> ' . htmlspecialchars($data['nama_instansi']) . '</p>';
        $html .= '<p><strong>Jenis Kerjasama:</strong> ' . htmlspecialchars($data['jenis_kerjasama']) . '</p>';
        $html .= '<p><strong>Topik Kerjasama:</strong> ' . htmlspecialchars($data['topik_kerjasama']) . '</p>';
        $html .= '<p><strong>Jangka Waktu:</strong> ' . htmlspecialchars($data['jangka_waktu']) . '</p>';
        $html .= '<p><strong>Awal Kerjasama:</strong> ' . htmlspecialchars($data['awal_kerjasama']) . '</p>';
        $html .= '<p><strong>Akhir Kerjasama:</strong> ' . htmlspecialchars($data['akhir_kerjasama']) . '</p>';
        $html .= '<p><strong>Jurusan Terkait:</strong> ' . htmlspecialchars($data['jurusan_terkait']) . '</p>';
        $html .= '<p><strong>Status:</strong> ' . htmlspecialchars($data['keterangan']) . '</p>';
    } else {
        die("Data tidak ditemukan!");
    }
} else {
    die("ID tidak valid!");
}

// Konfigurasi Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Load HTML ke Dompdf
$dompdf->loadHtml($html);

// Set ukuran kertas dan orientasi
$dompdf->setPaper('A4', 'portrait');

// Render HTML ke PDF
$dompdf->render();

// Unduh PDF
$dompdf->stream("Detail_Kerjasama_$id.pdf", ["Attachment" => true]);
?>
