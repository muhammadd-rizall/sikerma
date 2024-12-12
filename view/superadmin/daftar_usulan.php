<?php
    include"../sikerma/database/koneksi.php";

    $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

    switch ($aksi):
        case "list":
        // Query untuk mengambil data dari tabel `tb_usulan_kerjasama`
        $sql = "SELECT * FROM tb_usulan_kerjasama ORDER BY id_usulan DESC";
        $result = $conn->query($sql);
    ?>


        <div class="container">
                <h2>Daftar Usulan</h2>
                <a href="?p=daftarUsulan&aksi=input" class=""></a>
                <table id="daftar-usulan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Instansi</th>
                            <th>Nama Penjabat</th>
                            <th>Nama Jabatan</th>
                            <th>Nama Kontak Person</th>
                            <th>Nomor Kontak</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Dokumen</th>
                            <th>Status Permohonan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($daftarUsulan = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= htmlspecialchars($daftarUsulan['nama_instansi']); ?></td>
                                    <td><?= htmlspecialchars($daftarUsulan['nama_penjabat']); ?></td>
                                    <td><?= htmlspecialchars($daftarUsulan['nama_jabatan']); ?></td>
                                    <td><?= htmlspecialchars($daftarUsulan['nama_kontak_person']); ?></td>
                                    <td><?= htmlspecialchars($daftarUsulan['nomor_kontak']); ?></td>
                                    <td><?= htmlspecialchars($daftarUsulan['email']); ?></td>
                                    <td><?= htmlspecialchars($daftarUsulan['alamat']); ?></td>
                                    <td>
                                        <a href="/upload/documents/<?= htmlspecialchars($daftarUsulan['dokumen']); ?>" target="_blank">Lihat</a>
                                    </td>
                                    <td><?= htmlspecialchars($daftarUsulan['status_permohonan']); ?></td>
                                    <td class="action-buttons">
                                        <div class="row">
                                            <div class="col-12">
                                                <?php
                                                if ($daftarUsulan['status_permohonan'] == 'Pending') {
                                                    ?>
                                                    <a href="/view/superadmin/proses_daftar_usulan.php?id_progres=<?= $daftarUsulan['id_usulan']; ?>&action=progress" class="btn btn-warning">Next Progress</a>
                                                    <a href="/view/superadmin/proses_daftar_usulan.php?id_reject=<?= $daftarUsulan['id_usulan']; ?>&action=reject" class="btn btn-danger">Tolak</a>
                                                    <?php
                                                } elseif ($daftarUsulan['status_permohonan'] == 'In Progress') {
                                                    ?>
                                                    <a href="/view/superadmin/proses_daftar_usulan.php?id_approve=<?= $daftarUsulan['id_usulan']; ?>&action=approve" class="btn btn-success">Approve</a>
                                                    <a href="/view/superadmin/proses_daftar_usulan.php?id_reject=<?= $daftarUsulan['id_usulan']; ?>&action=reject" class="btn btn-danger">Tolak</a>
                                                    <?php
                                                } elseif ($daftarUsulan['status_permohonan'] == 'Approved') {
                                                    ?>
                                                    <span class="badge badge-success">Approved</span>
                                                    <?php
                                                }
                                                ?>
                                                <a href="/view/superadmin/proses_daftar_usulan.php?proses=delete&id_hapus=<?= $daftarUsulan['id_usulan'] ?>" class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <?php
                                $no++;
                            }
                        } 
                        ?>
                    </tbody>
                </table>
        </div>
        

<?php
        break;
endswitch;
?>
