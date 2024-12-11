<?php
         $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
         switch ($aksi) :
             case "list":  
?>


                <div class="container"></div>
                        <h2 class="">Tabel Kegiatan</h2>
                        <a href="?p=dataKegiatan&aksi=input" class="btn btn-primary mb-3 mt-10">Tambah Kegiatan</a>
                        <table id="tabel-kegiatan" class="table table-bordered table-striped">
                                <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kegiatan</th>
                                            <th>Deskripsi Kegiatan</th>
                                            <th>Dokumentasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                </thead>
                            <tbody>
                                        <?php
                                        include ("../sikerma/database/koneksi.php");
                                        
                                        $no = 1;
                                        $ambil = mysqli_query($conn, "SELECT * FROM tb_kegiatan_kerjasama");
                                        while ($dataKegiatan = mysqli_fetch_array($ambil)) :
                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $dataKegiatan['kegiatan'] ?></td>
                                                <td><?= $dataKegiatan['deskripsi_kegiatan'] ?></td>
                                                <td>
                                                <a href="/upload/img/<?php echo htmlspecialchars($dataKegiatan['dokumentasi']); ?>" target="_blank" download>Lihat Gambar</a>
                                                </td>
                                                <td>
                                                <a href="../../index.php?p=dataKegiatan&aksi=edit&id_edit=<?= $dataKegiatan['id_kegiatan'] ?>" class="btn btn-warning">Edit</a>
                                                    <a href="/view/superadmin/proses_kegiatan.php?proses=delete&id_hapus=<?= $dataKegiatan['id_kegiatan'] ?>"
                                                    class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')"><i
                                                    class="bi bi-trash"></i></a>
                                            </tr>
                                <?php
                                        $no++;
                                        endwhile;
                                    ?>
                            </tbody>
                        </table>
                    </div>

    <?php
        break;
        case "input":
    ?>          
            <!-- input kegiatan -->
           <div class="container mt-5">
           <h2 class="text-center">form kegiatan</h2>
              <form action="../view/superadmin/proses_kegiatan.php?proses=insert" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="kegiatan">Kegiatan</label>
                            <input type="text" class="form-control" id="kegiatan" name="kegiatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
                            <textarea class="form-control" id="deskripsi_kegiatan" name="deskripsi_kegiatan" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="dokumentasi">Dokumentasi</label>
                            <input type="file" class="form-control-file" id="dokumentasi" name="dokumentasi" accept="image/*" multiple required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

           </div>


        <?php
            break;

             case "edit":
                include '../sikerma/database/koneksi.php';
                 $id_edit = $_GET['id_edit'];
                 $ambil = mysqli_query($conn, "SELECT * FROM tb_kegiatan_kerjasama WHERE id_kegiatan = '$id_edit'");
                 $dataKegiatan = mysqli_fetch_array($ambil);
        ?>

        <!-- edit kegiatan -->
         <div class="container mt-5"></div>
                <h2 class="text-center">Edit Kegiatan</h2>
                <form action="../view/superadmin/proses_kegiatan.php?proses=update" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3 mt-3">
                        <label for="kegiatan">Kegiatan</label>
                        <input type="text" class="form-control" id="kegiatan" name="kegiatan" value="<?= $dataKegiatan['kegiatan'] ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
                        <textarea class="form-control" id="deskripsi_kegiatan" name="deskripsi_kegiatan" required><?= $dataKegiatan['deskripsi_kegiatan'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="dokumentasi">Dokumentasi</label>
                        <input type="file" class="form-control-file" id="dokumentasi" accept="image/*" name="dokumentasi" <?= $dataKegiatan['dokumentasi'] ?> multiple required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">submit</button>
                </form>
        </div>

     <?php
        break;
        endswitch;
     ?>
