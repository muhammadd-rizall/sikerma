<?php
      $aksi = isset($_POST['aksi']) ? $_GET['aksi'] : 'list';
      switch ($aksi) :
          case "list":  
?>
                <h2>Data Mitra</h2>
                <a href="" class="btn btn-primary mb-2">Tambah Data Mitra</a>
                <table id="tabel-mitra" class="table table-bordered table-striped">
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
                            <th>Negara</th>
                            <th>Website</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $conn = include '../../database/koneksi.php';
                        
                            $no = 1;
                            $ambil = mysqli_query($koneksi, "SELECT * FROM tb_mitra");
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
                                    <td><?= $dataMitra['negara']?></td>
                                    <td><?= $dataMitra['website']?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $dataMitra['id_mitra']?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="hapus.php?id=<?= $dataMitra['id_mitra']?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
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
                <!-- form data mitra -->
                <div class="container mt-5">
                        <h2 class="text-center">Form Data Mitra</h2>
                        <form action="proses_data_mitra.php?proses=insert" method="post" >
                                <!-- nama instansi -->
                                <div class="mb-3">
                                        <label for="nama-instansi">Nama Instansi</label>
                                        <input type="text" name="nama-instansi" id="nama-instansi" class="from-control" required>
                                </div>

                                <!-- email -->
                                <div class="mb-3">
                                        <label for="email-instansi">Email Instansi</label>
                                        <input type="email" name="email-instansi" id="email-instansi" class="from-control" required>
                                </div>

                                <!-- bidang usaha -->
                                <div class="mb-3">
                                        <label for="bidang-usaha">Bidang Usaha</label>
                                        <input type="text" name="bidang-usaha" id="bidang-usaha" class="from-control" required>
                                </div>

                                <!-- nomor-telphone -->
                                <div class="mb-3">
                                        <label for="no-tlp">Nomor Telphone</label>
                                        <input type="tel" name="no-tlp" id="no-tlp" class="from-control" required>
                                </div>

                                <!-- alamat -->
                                <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Alamat Instansi</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat-instansi"></textarea>
                                </div>

                                <!-- kota -->
                                <div class="mb-3">
                                        <label for="kota">Kota</label>
                                        <input type="text" name="kota" id="kota" class="from-control" required>
                                </div>

                                <!-- provinsi -->
                                <div class="mb-3">
                                        <label for="provinsi">Provinsi</label>
                                        <input type="text" name="provinsi" id="provinsi" class="from-control" required>
                                </div>

                                <!-- negara -->
                                <div class="mb-3">
                                        <label for="negara">Negara</label>
                                        <input type="text" name="negara" id="negara" class="from-control" >
                                </div>

                                <!-- webiste -->
                                <div class="mb-3">
                                        <label for="website">Website</label>
                                        <input type="text" name="website" id="website" class="from-control" >
                                </div>
                                
                                <!-- submit -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
        <?php
        break;

        case "edit":
                include "../../database/koneksi.php";
                $edit = mysqli_query($koneksi, "SELECT * FROM tb_mitra WHERE id_mitra = '$_GET[id_mitra]'");
                $dataMitra = mysqli_fetch_array($edit);    
        ?>

                <!-- edit data mitra -->
                <div class="container mt-5">
                        <h2 class="text-center">Form Data Mitra</h2>
                        <form action="proses_data_mitra.php?proses=update" method="post" >
                                <!-- ID -->
                                <input type="number" name="id" id="id" class="form-control" value="<?=$dataMitra['id_mitra'] ?>" hidden>
                                
                                <!-- nama instansi -->
                                <div class="mb-3">
                                        <label for="nama-instansi">Nama Instansi</label>
                                        <input type="text" name="nama-instansi" id="nama-instansi" class="from-control" value="<?=$dataMitra['nama_instansi'] ?>" required>
                                </div>

                                <!-- email -->
                                <div class="mb-3">
                                        <label for="email-instansi">Email Instansi</label>
                                        <input type="email" name="email-instansi" id="email-instansi" class="from-control" value="<?=$dataMitra['email_instansi'] ?>" required>
                                </div>

                                <!-- bidang usaha -->
                                <div class="mb-3">
                                        <label for="bidang-usaha">Bidang Usaha</label>
                                        <input type="text" name="bidang-usaha" id="bidang-usaha" class="from-control" value="<?=$dataMitra['bidang_usaha'] ?>" required>
                                </div>

                                <!-- nomor-telphone -->
                                <div class="mb-3">
                                        <label for="no-tlp">Nomor Telphone</label>
                                        <input type="tel" name="no-tlp" id="no-tlp" class="from-control" value="<?=$dataMitra['no_telp'] ?>" required>
                                </div>

                                <!-- alamat -->
                                <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Alamat Instansi</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat-instansi" required>value="<?=$dataMitra['alamat_instansi'] ?>"</textarea>
                                </div>

                                <!-- kota -->
                                <div class="mb-3">
                                        <label for="kota">Kota</label>
                                        <input type="text" name="kota" id="kota" class="from-control" value="<?=$dataMitra['kota'] ?>" required>
                                </div>

                                <!-- provinsi -->
                                <div class="mb-3">
                                        <label for="provinsi">Provinsi</label>
                                        <input type="text" name="provinsi" id="provinsi" class="from-control" value="<?=$dataMitra['provinsi'] ?>" required>
                                </div>

                                <!-- negara -->
                                <div class="mb-3">
                                        <label for="negara">Negara</label>
                                        <input type="text" name="negara" id="negara" class="from-control"  value="<?=$dataMitra['negara'] ?>">
                                </div>

                                <!-- webiste -->
                                <div class="mb-3">
                                        <label for="website">Website</label>
                                        <input type="text" name="website" id="website" class="from-control" value="<?=$dataMitra['website'] ?>">
                                </div>
                                
                                <!-- submit -->
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
        <?php
        break;
        endswitch;
        ?>
