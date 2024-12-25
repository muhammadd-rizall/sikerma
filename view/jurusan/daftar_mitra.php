<?php
include "../sikerma/database/koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi):
    case "list":
        // Query untuk mengambil data dari tabel `tb_mitra`
        $sql = "SELECT tb_mou_moa.no_mou_moa, tb_mitra.nama_instansi, tb_mou_moa.jenis_kerjasama, tb_mou_moa.topik_kerjasama, 
        tb_mou_moa.jangka_waktu, tb_mou_moa.awal_kerjasama, tb_mou_moa.akhir_kerjasama, tb_mou_moa.jurusan_terkait, 
        tb_mou_moa.keterangan, tb_mou_moa.file_dokumen FROM tb_mou_moa JOIN tb_mitra  ON tb_mou_moa.id_mitra = tb_mitra.id_mitra ";


        $result = $conn->query($sql);

        
?>

<div class="container">
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
                <th>file dokumen</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
            $no = 1;
            while ($daftarMitra = $result->fetch_assoc()): ?>
            
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= htmlspecialchars($daftarMitra['no_mou_moa']); ?></td>
                    <td><?= htmlspecialchars($daftarMitra['nama_instansi']); ?></td>
                    <td><?= htmlspecialchars($daftarMitra['jenis_kerjasama']); ?></td>
                    <td><?= htmlspecialchars($daftarMitra['topik_kerjasama']); ?></td>
                    <td><?= htmlspecialchars($daftarMitra['jangka_waktu']); ?></td>
                    <td><?= htmlspecialchars($daftarMitra['awal_kerjasama']); ?></td>
                    <td><?= htmlspecialchars($daftarMitra['akhir_kerjasama']); ?></td>
                    <td><?= htmlspecialchars($daftarMitra['jurusan_terkait']); ?></td>
                    <td><?= htmlspecialchars($daftarMitra['keterangan']); ?></td>
                    <td>
                                <?php
                                    $fileDokumen = $daftarMitra['file_dokumen'];

                                        // Cek apakah tautan berasal dari Google Drive
                                     if (strpos($fileDokumen, 'drive.google.com') !== false): ?>
                                    <!-- Tampilkan tombol untuk membuka di Google Drive -->
                                    <a href="<?= htmlspecialchars($fileDokumen); ?>" target="_blank" class="btn btn-sm btn-primary" ><i class="fa fa-eye"></i></a>
                                    <?php else: ?>
                                    <!-- Tampilkan tombol untuk dokumen lokal -->
                                     <a href="/upload/documents/<?= htmlspecialchars($fileDokumen); ?>" target="_blank" class="btn btn-sm btn-primary" Download><i class="fa fa-eye"></i></a>
                                    <?php endif; ?>
                        </td>

                    <td class="text-nowrap">
                        <a href="/view/jurusan/download_pdf.php?id=<?= htmlspecialchars($daftarMitra['no_mou_moa']); ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                    </td>
                    


                </tr>
                <?php
                $no++;
            endwhile;
        }
            ?>
        </tbody>
    </table>
</div>

<?php
        break;
endswitch;
?>