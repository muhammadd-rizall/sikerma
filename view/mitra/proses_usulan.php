<?php
    include "../sikerma/database/koneksi.php";

    $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
   
    $user_id = $_SESSION['id_user'];

    switch ($aksi):
        case "list":
        // Query untuk mengambil data dari tabel `tb_usulan_kerjasama`
        $sql = "SELECT * FROM tb_usulan_kerjasama WHERE id_user = $user_id ORDER BY id_usulan DESC";
        $result = $conn->query($sql);
    ?>


        <div class="container">
                <h2>Proses Usulan</h2>
                <a href="?p=prosesUsulan&aksi=input" class=""></a>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($prosesUsulan = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= htmlspecialchars($prosesUsulan['nama_instansi']); ?></td>
                                    <td><?= htmlspecialchars($prosesUsulan['nama_penjabat']); ?></td>
                                    <td><?= htmlspecialchars($prosesUsulan['nama_jabatan']); ?></td>
                                    <td><?= htmlspecialchars($prosesUsulan['nama_kontak_person']); ?></td>
                                    <td><?= htmlspecialchars($prosesUsulan['nomor_kontak']); ?></td>
                                    <td><?= htmlspecialchars($prosesUsulan['email']); ?></td>
                                    <td><?= htmlspecialchars($prosesUsulan['alamat']); ?></td>
                                    <td>
                                        <a href="/upload/documents/<?= htmlspecialchars($prosesUsulan['dokumen']); ?>" target="_blank">Lihat</a>
                                    </td>
                                    <td><?= htmlspecialchars($prosesUsulan['status_permohonan']); ?></td>

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
