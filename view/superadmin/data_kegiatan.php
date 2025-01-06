<?php
         $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
         switch ($aksi) :
             case "list":  
?>


                
                        <h2 class="mt-3">Tabel Kegiatan</h2>
                        <a href="?p=dataKegiatan&aksi=input" class="btn-add mt-4 mb-4"><i class="fa-sharp fa-solid fa-plus"></i> Kegiatan</a>
                        <table id="tabel-kegiatan" class="table table-bordered table-striped">
                                <thead>
                                        <tr>
                                            <th>Nooooo</th>
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
                                                <a href="/upload/img/<?php echo htmlspecialchars($dataKegiatan['dokumentasi']); ?>" target="_blank" download><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td class="text-nowrap">
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
                    

    <?php
        break;
        case "input":

            include ("../sikerma/database/koneksi.php");
            $kegiatanQuery = mysqli_query($conn, "SELECT tb_mou_moa.id_mou_moa, tb_mitra.nama_instansi, tb_mou_moa.jenis_kerjasama FROM tb_mou_moa JOIN tb_mitra ON tb_mou_moa.id_mitra = tb_mitra.id_mitra;");
    ?>          
            <!-- input kegiatan -->
           <div class=" mt-5">
                <h2 class="text-center">form kegiatan</h2>
              <form action="../view/superadmin/proses_kegiatan.php?proses=insert" method="post" enctype="multipart/form-data">

              

                        <div class="mb-3">
                            <label for="id_mou_moa">Pilih Mou/Moa/Ia</label>
                            <select name="id_mou_moa" id="id_mou_moa" class="form-control" required>
                                <option value="">--Pilih Mou/Moa/Ia--</option>
                                <?php while ($kegiatan = mysqli_fetch_assoc($kegiatanQuery)): ?>
                                    <option value="<?= $kegiatan['id_mou_moa'] ?>">
                                        <?= $kegiatan['nama_instansi'] . ' - ' . $kegiatan['jenis_kerjasama'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

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

                    
                        <button type="submit" name="submit" class="btn-submit">Submit</button>
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
         <div class=" mt-5"></div>
                <h2 class="text-center">Edit Kegiatan</h2>
                <form action="../view/superadmin/proses_kegiatan.php?proses=update" method="post" enctype="multipart/form-data">

                        <!-- id mitra -->
              <input type="number" name="id_kegiatan" id="id_kegiatan" class="form-control" value="<?=$dataKegiatan['id_kegiatan'] ?>" hidden>

                    <div class="mb-3">
                            <label for="id_mou_moa">Pilih Nama instansi dan jenis kerjasamanya</label>
                            <select name="id_mou_moa" id="id_mou_moa" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <?php
                                    $kegiatanQuery = mysqli_query($conn, "SELECT tb_mou_moa.id_mou_moa, tb_mitra.nama_instansi, tb_mou_moa.jenis_kerjasama FROM tb_mou_moa JOIN tb_mitra ON tb_mou_moa.id_mitra = tb_mitra.id_mitra;");
                                     while ($kegiatan = mysqli_fetch_array($kegiatanQuery)): 
                                ?>
                                <option value="<?= $kegiatan['id_mou_moa'] ?>">
                                        <?= $kegiatan['nama_instansi'] . ' - ' . $kegiatan['jenis_kerjasama'] ?>
                                    </option>
                            <?php endwhile; ?>
                            </select>
                        </div>

                    

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
                    <button type="submit" name="submit" class="btn-submit">submit</button>
                </form>
        </div>

     <?php
        break;
        endswitch;
     ?>
