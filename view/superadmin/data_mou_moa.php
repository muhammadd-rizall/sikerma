<?php
    $aksi = isset($_POST['aksi']) ? $_GET['aksi'] : 'list';
    switch ($aksi) :
        case "list":
?>

        <h2>Data Mou/Moa</h2>
        <a href="" class="btn btn-primary mb-2">Tambah Data Mou/Moa</a>
        <table id="tabel-mou-moa" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Mou/Moa</th>
                    <th>Jenis Kerjasama</th>
                    <th>Jangka Waktu</th>
                    <th>Awal Kerjasama</th>
                    <th>Akhir Kerjasama</th>
                    <th>Keterangan</th>
                    <th>Jurusan Terkait</th>
                    <th>Topik Kerjasama</th>
                    <th>File Dokumen</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                    <?php
                        $conn = include '../../database/koneksi.php';
                        
                        $no = 1;
                        $ambil = mysqli_query($koneksi, "SELECT * FROM tb_mou_moa");
                        while ($dataMouMoa = mysqli_fetch_array($ambil)) :
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $dataMouMoa['no_mou_moa'] ?></td>
                                <td><?= $dataMouMoa['jenis_kerjasama'] ?></td>
                                <td><?= $dataMouMoa['jangka_waktu'] ?></td>                       
                                <td><?= $dataMouMoa['awal_kerjasama'] ?></td>
                                <td><?= $dataMouMoa['akhir_kerjasama'] ?></td>
                                <td><?= $dataMouMoa['keterangan'] ?></td>
                                <td><?= $dataMouMoa['jurusan_terkait'] ?></td>
                                <td><?= $dataMouMoa['topik_kerjasama'] ?></td>
                                <td>
                                    <?php if ($dataMouMoa['file_dokumen']): ?>
                                    <a href="uploads/documents/<?= $dataMouMoa['file_dokumen'] ?>" target="_blank">Lihat Dokumen</a>
                                    <?php else: ?>
                                    Belum diunggah
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="index.php?p=mhs&aksi=edit&id_edit=<?= $dataMouMoa['nim'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="proses_mahasiswa.php?proses=delete&id_hapus=<?= $dataMouMoa['nim'] ?>" class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data?')">Hapus</a>
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


        <!-- form tambah data Mou/moa -->
        <div class="conatiner mt-5">
            <h2 class="text-center">Form Mou / Moa</h2>
            <form action="">
                <!-- nomor mou/moa -->
                <div class="mb-3">
                    <label for="nomor-mou-moa"> Nomor Mou/Moa</label>
                    <input type="text" name="nomor-mou-moa" id="nomor-mou-moa" class="from-control" required>
                </div>

                <!-- jenis kerjasama -->
                <div class="mb-3">
                    <label for="Jenis kerjasama"> Jenis Kerjasama</label>
                    <input type="text" name="Jenis kerjasama" id="Jenis kerjasama" class="from-control" required>
                </div>

                <!-- jangaka  waktu -->
                <div class="mb-3">
                    <label for="Jangka Waktu"> Jangka Waktu</label>
                    <input type="text" name="Jangka Waktu" id="Jangka Waktu" class="from-control" required>
                </div>

                <!-- awal kerejasama -->
                <div class="mb-3">
                    <label for="awal kerjasama"> Awal Kerjasama</label>
                    <input type="text" name="awal kerjasama" id="awal kerjasama" class="from-control" required>
                </div>

                <!-- akhir kerjasama -->
                <div class="mb-3">
                    <label for="akhir kerjasama"> Akhir Kerjasama</label>
                    <input type="text" name="akhir kerjasama" id="akhir kerjasama" class="from-control" required>
                </div>

                <!-- keterangan -->
                <div class="mb-3">
                    <label for="Keterangan"> Keterangan</label>
                    <select name="keteranagn" id="">
                        <option value="">Pilih Keterangan</option>
                        <option value="1">Aktif</option>
                        <option value="2">Tidak Aktif</option>
                    </select>
                </div>

                <!-- jurusan terkait -->
                <div class="mb-3">
                    <label for="jurusan-terkait">Jurusan Terkait</label>
                    <select name="jurusan-terkait" id="">
                        <option value="">Pilih Keterangan</option>
                        <option value="1">Teknologi Informasi</option>
                        <option value="2">Teknik Mesin</option>
                        <option value="3">Teknik Sipil</option>
                        <option value="4">Teknik Elektro</option>
                        <option value="5">Administrasi Niaga</option>
                        <option value="6">Akuntasi</option>
                        <option value="7">Bahasa Inggris</option>
                    </select>
                </div>

                <!-- topik kerjasama -->
                <div class="mb-3">
                    <label for="topik-kerjasama">Topik Kerjasama</label>
                    <input type="text" name="topik-kerjasama" id="topik-kerjasama" class="from-control" required>
                </div>

                <!-- upload dokumen -->
                <div class="mb-3">
                        <label for="file" class="form-label">Upload Dokumen</label>
                        <input type="file" name="file" id="file" class="form-control"  accept=".pdf,.doc,.docx,.xls,.xlsx" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>

     <?php
    break;

        case "edit":
        include "../../database/koneksi.php";
        $edit = mysqli_query($db, "SELECT * FROM tb_data_mou_moa WHERE id = '$_GET[id_data_mou_moa]'");
        $data_mahasiswa = mysqli_fetch_array($edit);
    ?>


        <!-- edit data mou/moa -->
        <div class="conatiner mt-5">
            <h2 class="text-center">Form Mou / Moa</h2>
            <form action="" method="post" enctype="multipart/form-data">
                        
                <!-- ID -->
                <input type="number" name="id" id="id" class="form-control" value="<?=$dataMouMoa['id'] ?>" hidden>

                <!-- nomor mou/moa -->
                <div class="mb-3">
                    <label for="nomor-mou-moa">Nomor Mou/Moa</label>
                    <input type="text" name="nomor-mou-moa" id="nomor-mou-moa" class="from-control" value="<?=$dataMouMoa['no_mou_moa'] ?>" required>
                </div>

                <!-- jenis kerjasama -->
                <div class="mb-3">
                    <label for="Jenis kerjasama">Jenis Kerjasama</label>
                    <input type="text" name="Jenis kerjasama" id="Jenis kerjasama" class="from-control" value="<?=$dataMouMoa['jenis_kerjasama'] ?>" required>
                </div>

                <!-- jangaka  waktu -->
                <div class="mb-3">
                    <label for="Jangka Waktu">Jangka Waktu</label>
                    <input type="text" name="Jangka Waktu" id="Jangka Waktu" class="from-control" value="<?=$dataMouMoa['jangka_waktu'] ?>" required>
                </div>

                <!-- awal kerejasama -->
                <div class="mb-3">
                    <label for="awal kerjasama">Awal Kerjasama</label>
                    <input type="text" name="awal kerjasama" id="awal kerjasama" class="from-control" value="<?=$dataMouMoa['awal_kerjasama'] ?>" required>
                </div>

                <!-- akhir kerjasama -->
                <div class="mb-3">
                    <label for="akhir kerjasama">Akhir Kerjasama</label>
                    <input type="text" name="akhir kerjasama" id="akhir kerjasama" class="from-control" value="<?=$dataMouMoa['akhir_kerjasama'] ?>" required>
                </div>

                <!-- keterangan -->
                <div class="mb-3">
                    <label for="Keterangan">Keterangan</label>
                        <select name="keterangan" id="keterangan" class="form-control">
                            <option value="">Pilih Keterangan</option>
                                <?php
                                    // Mengambil data dari database
                                        include '../../database/koneksi.php';
                                        $query = mysqli_query($koneksi, "SELECT keterangan FROM tb_mou_moa");
                                        while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['keterangan'] ?></option>
                                        <?php
                                        }
                                        ?>
                        </select>
                    </div>


                <!-- jurusan terkait -->
                <div class="mb-3">
                    <label for="jurusan-terkait">Jurusan Terkait</label>
                            <select name="jurusan-terkait" id="jurusan-terkait" class="form-control">
                                <option value="">Pilih Jurusan</option>
                                    <?php
                                            // Sambungkan dengan database Anda
                                                include '../../database/koneksi.php';
                
                                            // Query untuk mengambil data jurusan dari database
                                                $query = mysqli_query($koneksi, "SELECT jurusan_terkait FROM tb_mou_moa");
                                                
                                            // Perulangan untuk menampilkan setiap opsi
                                                while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                                    <option value="<?= $row['id'] ?>"><?= $row['jurusan_terkait'] ?></option>
                                                <?php
                                                }
                                                ?>
                                </select>
                    </div>


                <!-- topik kerjasama -->
                <div class="mb-3">
                    <label for="topik-kerjasama">Topik Kerjasama</label>
                    <input type="text" name="topik-kerjasama" id="topik-kerjasama" class="from-control" value="<?=$dataMouMoa['topik_kerjasama'] ?>" required>
                </div>

                <!-- upload dokumen -->
                <div class="mb-3">
                        <label for="file" class="form-label">P</label>
                        <input type="file" name="file" id="file" class="form-control"  accept=".pdf,.doc,.docx,.xls,.xlsx" value="<?=$dataMouMoa['file_dokumen'] ?>" required>
                </div>

            </form>
        </div>

    <?php
        break;
        endswitch;
    ?>