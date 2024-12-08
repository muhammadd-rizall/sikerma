<?php
      $aksi = isset($_POST['aksi']) ? $_GET['aksi'] : 'list';
      switch ($aksi) :
          case "list": 
            
            // Query untuk mengambil data dari tabel `usulan_kerjasama`
            $sql = "SELECT * FROM usulan_kerjasama ORDER BY id_usulan DESC";
            $result = $conn->query($sql);
?>

            <h2>Daftar Usulan</h2>
            <a href="../mitra/form_pengajuan.php" class=""></a>
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
                            echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$daftarUsulan['nama_instansi']}</td>
                                    <td>{$daftarUsulan['nama_penjabat']}</td>
                                    <td>{$daftarUsulan['nama_jabatan']}</td>
                                    <td>{$daftarUsulan['nama_kontak_person']}</td>
                                    <td>{$daftarUsulan['nomor_kontak']}</td>
                                    <td>{$daftarUsulan['email']}</td>
                                    <td>{$daftarUsulan['alamat']}</td>
                                    <td><a href='uploads/{$daftarUsulan['dokumen_usulan']}' target='_blank'>Lihat</a></td>
                                    <td>{$daftarUsulan['status_permohonan']}</td>
                                    <td class='action-buttons'>
                                        <button class='btn-show'>Show</button>
                                        <button class='btn-edit'>Edit</button>
                                        <button class='btn-delete'>Delete</button>
                                    </td>
                                  </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='11' style='text-align: center;'>Tidak ada data.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>