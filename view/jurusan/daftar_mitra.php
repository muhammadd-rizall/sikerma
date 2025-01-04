<?php
include "../sikerma/database/koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi):
    case "list":
        // Query untuk mengambil data dari tabel `tb_mou_moa`
        $sql = "SELECT tb_mou_moa.no_mou_moa, tb_mitra.nama_instansi, tb_mou_moa.jenis_kerjasama, tb_mou_moa.topik_kerjasama, 
        tb_mou_moa.jangka_waktu, tb_mou_moa.awal_kerjasama, tb_mou_moa.akhir_kerjasama, tb_mou_moa.jurusan_terkait,
        tb_mou_moa.file_dokumen FROM tb_mou_moa JOIN tb_mitra ON tb_mou_moa.id_mitra = tb_mitra.id_mitra";

        $result = $conn->query($sql);
?>


    <h2>Daftar Mitra</h2>
    <a href="?p=daftarMitra&aksi=input" class=""></a>
    <table id="daftar-mitra" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>NO</th>
                <th>No MOU/MOA</th>
                <th>Nama Mitra</th>
                <th>Jenis Kerjasama</th>
                <th>Topik Kerjasama</th>
                <th>Jangka Waktu</th>
                <th>Awal Kerjasama</th>
                <th>Akhir Kerjasama</th>
                <th>Jurusan Terkait</th>
                <th>Status</th>
                <th>File Dokumen</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if ($result->num_rows > 0) {
                $no = 1;
                while ($daftarMitra = $result->fetch_assoc()):
                    $awalKerjasama = $daftarMitra['awal_kerjasama'];
                    $akhirKerjasama = $daftarMitra['akhir_kerjasama'];
                    $today = date('Y-m-d');

                    // Menentukan status aktif atau tidak aktif
                    if ($today >= $awalKerjasama && $today <= $akhirKerjasama) {
                        $status = "Aktif";
                    } else {
                        $status = "Tidak Aktif";
                    }

                    $statusColor = ($status === "Aktif") ? "text-success" : "text-danger";
        ?>

        <tr>
            <td><?= $no; ?></td>
            <td><?= $daftarMitra['no_mou_moa']; ?></td>
            <td><?= $daftarMitra['nama_instansi']; ?></td>
            <td><?= $daftarMitra['jenis_kerjasama']; ?></td>
            <td><?= $daftarMitra['topik_kerjasama']; ?></td>
            <td><?= $daftarMitra['jangka_waktu']; ?></td>
            <td><?= $daftarMitra['awal_kerjasama']; ?></td>
            <td><?= $daftarMitra['akhir_kerjasama']; ?></td>
            <td><?= $daftarMitra['jurusan_terkait']; ?></td>
            <td class="<?= $statusColor; ?>"><?= $status; ?></td>
            <td>
                <?php
                $fileDokumen = $daftarMitra['file_dokumen'];

                // Cek apakah tautan berasal dari Google Drive
                if (strpos($fileDokumen, 'drive.google.com') !== false): ?>
                    <!-- Tampilkan tombol untuk membuka di Google Drive -->
                    <a href="<?= $fileDokumen; ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                <?php else: ?>
                    <!-- Tampilkan tombol untuk dokumen lokal -->
                    <a href="/upload/documents/<?= $fileDokumen; ?>" target="_blank" class="btn btn-sm btn-primary" download><i class="fa fa-eye"></i></a>
                <?php endif; ?>
            </td>
            <td class="text-nowrap">
                <a href="/view/jurusan/download_pdf.php?id=<?= $daftarMitra['no_mou_moa']; ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-cloud-arrow-down"></i></a>
            </td>
        </tr>

        <?php
                $no++;
                endwhile;
            }
        ?>

        </tbody>
    </table>


<?php
        break;
endswitch;
?>
