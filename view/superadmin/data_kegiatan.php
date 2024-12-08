<?php
         $aksi = isset($_POST['aksi']) ? $_GET['aksi'] : 'list';
         switch ($aksi) :
             case "list":  
?>

        <h2>Tabel Kegiatan</h2>
        <a href="" class="btn btn-primary mb-2">Tambah Kegiatan</a>
        <table id="tabel-user" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>No</th>
                            <th>Kegiatan</th>
                            <th>Deskripsimm Kegiatan</th>
                            <th>Dokumentasi</th>
                            <th>Aksi</th>
                        </tr>
                </thead>
            <tbody>
                        <?php
                        $conn = include '../../database/koneksi.php';
                        
                        $no = 1;
                        $ambil = mysqli_query($koneksi, "SELECT * FROM tb_kegiatan_kerjasama");
                        while ($dataKegiatan = mysqli_fetch_array($ambil)) :
                        ?>
                               <tr>
                                <td><?= $no ?></td>
                                <td><?= $dataKegiatan['kegiatan'] ?></td>
                                <td><?= $dataKegiatan['deskripsi_kegiatan'] ?></td>
                                <td><?= $dataKegiatan['dokumentasi'] ?></td>
                                <td>
                                    <a href="index.php?p=mhs&aksi=edit&id_edit=<?= $dataKegiatan['id_user'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="proses_data_mou_moa.php?proses=delete&id_hapus=<?= $dataKegiatan['id_user'] ?>" class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data?')">Hapus</a>
                                </td>
                            </tr>
                   <?php
                        $no++;
                        endwhile;
                    ?>
               </tbody>
        </table>

    <?php
        break;
        case "input":
    ?>          
            <!-- input kegiatan -->
            <h2>form kegiatan</h2>
              <form action="proses_data_mou_moa.php?aksi=add" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Kegiatan</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Kegiatan</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="dokumentasi">Dokumentasi</label>
                            <input type="file" class="form-control-file" id="dokumentasi" name="dokumentasi" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                </form>

        <?php
            break;

             case "edit":
                 $id_edit = $_GET['id_edit'];
                 $ambil = mysqli_query($koneksi, "SELECT * FROM tb_kegiatan_kerjasama WHERE id_kegiatan = '$id_kegiatan'");
                 $dataKegiatan = mysqli_fetch_array($ambil);
        ?>

        <!-- edit kegiatan -->
        <h2>Edit Kegiatan</h2>
        <form action="proses_kegiatan.php?proses=update" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Kegiatan</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $dataKegiatan['kegiatan'] ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Kegiatan</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $dataKegiatan['deskripsi_kegiatan'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="dokumentasi">Dokumentasi</label>
                <input type="file" class="form-control-file" id="dokumentasi" name="dokumentasi" <?= $dataKegiatan['dokumentasi'] ?> required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>

     <?php
        break;
        endswitch;
     ?>
