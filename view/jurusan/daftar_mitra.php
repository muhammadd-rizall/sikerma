<?php
include "../sikerma/database/koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi):
    case "list":
        // Query untuk mengambil data dari tabel `tb_mitra`
        $sql = "SELECT tb_mou_moa.no_mou_moa, tb_mitra.nama_instansi, tb_mou_moa.jenis_kerjasama, tb_mou_moa.topik_kerjasama, 
        tb_mou_moa.jangka_waktu, tb_mou_moa.awal_kerjasama, tb_mou_moa.akhir_kerjasama, tb_mou_moa.jurusan_terkait, 
        tb_mou_moa.keterangan FROM tb_mou_moa JOIN tb_mitra  ON tb_mou_moa.id_mitra = tb_mitra.id_mitra ";


        $result = $conn->query($sql);

        var_dump($result);
        
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
                    <td class="text-nowrap">
                        <a href="/view/jurusan/download_pdf.php?id=<?= htmlspecialchars($daftarMitra['no_mou_moa']); ?>" class="btn btn-success btn-sm">Download PDF</a>
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