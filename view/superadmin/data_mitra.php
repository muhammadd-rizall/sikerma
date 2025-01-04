<?php
      $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
      switch ($aksi) :
          case "list":  
?>

      
                <h2>Data Mitra</h2>
                <div class="table-responsive"> 
                        <a href="?p=dataMitra&aksi=input" class="btn-add mt-4 mb-4"><i class="fa-sharp fa-solid fa-plus"></i> Data Mitra</a>
                        <table id="tabel-mitra" class="table table-bordered table-striped ">
                        <thead>
                                <tr>
                                <th>No</th>
                                <th>Nama Instansi</th>
                                <th>Email Instansi</th>
                                <th>Bidang Usaha</th>
                                <th>Nomor Telphone</th>
                                <th>Alamat Instansi</th>
                                <th>kota</th>
                                <th>Provinsi</th>
                                <th>Website</th>
                                <th>Aksi</th>
                                </tr>
                        </thead>

                        <tbody>
                                <?php
                                include ("../sikerma/database/koneksi.php");
                                
                                $no = 1;
                                $ambil = mysqli_query($conn, "SELECT * FROM tb_mitra");
                                while ($dataMitra = mysqli_fetch_array($ambil)) :
                        ?>
                                        <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $dataMitra['nama_instansi']?></td>
                                        <td><?= $dataMitra['email_instansi']?></td>
                                        <td><?= $dataMitra['bidang_usaha']?></td>
                                        <td><?= $dataMitra['no_telp']?></td>
                                        <td><?= $dataMitra['alamat_instansi']?></td>
                                        <td><?= $dataMitra['kota']?></td>
                                        <td><?= $dataMitra['provinsi']?></td>
                                        <td><?= $dataMitra['website']?></td>
                                        <td class="text-nowrap">
                                                <a href="../../index.php?p=dataMitra&aksi=edit&id_edit=<?= $dataMitra['id_mitra'] ?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="/view/superadmin/proses_data_mitra.php?proses=delete&id_hapus=<?= $dataMitra['id_mitra'] ?>"
                                                        class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')"><i
                                                        class="bi bi-trash"></i>
                                                </a>
                                        </td>
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
                <!-- form data mitra -->
                <div class=" mt-5">
                        <h2 class="text-center">Form Data Mitra</h2>
                        <form action="../view/superadmin/proses_data_mitra.php?proses=insert" method="POST">
                                <!-- Nama Instansi -->
                                <div class="mb-3">
                                <label for="nama_instansi" class="form-label">Nama Instansi</label>
                                <input type="text" name="nama_instansi" id="nama_instansi" class="form-control" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                <label for="email_instansi" class="form-label">Email Instansi</label>
                                <input type="email" name="email_instansi" id="email_instansi" class="form-control" required>
                                </div>

                                <!-- Bidang Usaha -->
                                <div class="mb-3">
                                <label for="bidang_usaha" class="form-label">Bidang Usaha</label>
                                <input type="text" name="bidang_usaha" id="bidang_usaha" class="form-control" required>
                                </div>

                                <!-- Nomor Telepon -->
                                <div class="mb-3">
                                <label for="no_telp" class="form-label">Nomor Telepon</label>
                                <input type="tel" name="no_telp" id="no_telp" class="form-control" required>
                                </div>

                                <!-- Alamat Instansi -->
                                <div class="mb-3">
                                <label for="alamat_instansi" class="form-label">Alamat Instansi</label>
                                <textarea class="form-control" id="alamat_instansi" rows="3" name="alamat_instansi" required></textarea>
                                </div>

                                <!-- Kota -->
                                <div class="mb-3">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" name="kota" id="kota" class="form-control" required>
                                </div>

                                <!-- Provinsi -->
                                <div class="mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" id="provinsi" class="form-control" required>
                                </div>

                                <!-- Website -->
                                <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" name="website" id="website" class="form-control">
                                </div>

                                <!-- Submit -->
                                <button type="submit"  name="submit" class="btn-submit">Submit</button>
                        </form>
                </div>

        <?php
        break;

        case "edit":
                include '../sikerma/database/koneksi.php';
                $edit = mysqli_query($conn, "SELECT * FROM tb_mitra WHERE id_mitra = '$_GET[id_edit]'");
                $dataMitra = mysqli_fetch_array($edit);    
        ?>

                <!-- edit data mitra -->
                <div class=" mt-5">
                        <h2 class="text-center">Edit Data Mitra</h2>
                        <form action="../view/superadmin/proses_data_mitra.php?proses=update" method="POST">

                                <!-- id mitra -->
                                <input type="number" name="id_mitra" id="id" class="form-control" value="<?=$dataMitra['id_mitra'] ?>" hidden>

                                <!-- Nama Instansi -->
                                <div class="mb-3">
                                        <label for="nama_instansi" class="form-label">Nama Instansi</label>
                                        <input type="text" name="nama_instansi" id="nama_instansi" class="form-control" value="<?=$dataMitra['nama_instansi'] ?>" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                        <label for="email_instansi" class="form-label">Email Instansi</label>
                                        <input type="email" name="email_instansi" id="email_instansi" class="form-control" value="<?=$dataMitra['email_instansi'] ?>" required>
                                </div>

                                <!-- Bidang Usaha -->
                                <div class="mb-3">
                                        <label for="bidang_usaha" class="form-label">Bidang Usaha</label>
                                        <input type="text" name="bidang_usaha" id="bidang_usaha" class="form-control" value="<?=$dataMitra['bidang_usaha'] ?>" required>
                                </div>

                                <!-- Nomor Telepon -->
                                <div class="mb-3">
                                        <label for="no_telp" class="form-label">Nomor Telepon</label>
                                        <input type="tel" name="no_telp" id="no_telp" class="form-control" value="<?=$dataMitra['no_telp'] ?>" required>
                                </div>

                                <!-- Alamat Instansi -->
                                <div class="mb-3">
                                        <label for="alamat_instansi" class="form-label">Alamat Instansi</label>
                                        <textarea class="form-control" id="alamat_instansi" rows="3" name="alamat_instansi" required><?=$dataMitra['alamat_instansi'] ?></textarea>
                                </div>

                                <!-- Kota -->
                                <div class="mb-3">
                                        <label for="kota" class="form-label">Kota</label>
                                        <input type="text" name="kota" id="kota" class="form-control" value="<?=$dataMitra['kota'] ?>" required>
                                </div>

                                <!-- Provinsi -->
                                <div class="mb-3">
                                        <label for="provinsi" class="form-label">Provinsi</label>
                                        <input type="text" name="provinsi" id="provinsi" class="form-control" value="<?=$dataMitra['provinsi'] ?>" required>
                                </div>

                                <!-- Website -->
                                <div class="mb-3">
                                        <label for="website" class="form-label">Website</label>
                                        <input type="url" name="website" id="website" class="form-control" value="<?=$dataMitra['website'] ?>">
                                </div>

                                <!-- Submit -->
                                <button type="submit"  name="submit" class="btn-submit">Submit</button>
                        </form>
                </div>
        <?php
        break;
        endswitch;
        ?>
