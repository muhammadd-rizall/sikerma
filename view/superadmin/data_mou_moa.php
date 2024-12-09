
<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi):
    case "list":
        ?>

        <h2>Data Mou/Moa</h2>
        <a href="?p=dataMouMoa&aksi=input" class="btn btn-primary mb-2">Tambah Data Mou/Moa</a>
        <table id="tabel-mou-moa" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Mou/Moa</th>
                    <th>Jenis Kerjasama</th>
                    <th>Topik Kerjasama</th>
                    <th>Jangka Waktu</th>
                    <th>Awal Kerjasama</th>
                    <th>Akhir Kerjasama</th>
                    <th>Jurusan Terkait</th>
                    <th>Keterangan</th>
                    <th>File Dokumen</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                include '../sikerma/database/koneksi.php';
                $no = 1;
                $ambil = mysqli_query($conn, "SELECT * FROM tb_mou_moa");
                while ($dataMouMoa = mysqli_fetch_array($ambil)):
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $dataMouMoa['no_mou_moa'] ?></td>
                        <td><?= $dataMouMoa['jenis_kerjasama'] ?></td>
                        <td><?= $dataMouMoa['topik_kerjasama'] ?></td>
                        <td><?= $dataMouMoa['jangka_waktu'] ?></td>
                        <td><?= $dataMouMoa['awal_kerjasama'] ?></td>
                        <td><?= $dataMouMoa['akhir_kerjasama'] ?></td>
                        <td><?= $dataMouMoa['jurusan_terkait'] ?></td>
                        <td><?= $dataMouMoa['keterangan'] ?></td>
                        <td>
                            <a href="../../upload/document/<?php echo htmlspecialchars($dataMouMoa['file_dokumen']); ?>"
                                target="_blank">Lihat</a>

                        </td>
                        <td>
                            <a href="/sikerma/index.php?p=dataMouMoa&aksi=edit&id_edit=<?= $dataMouMoa['nim'] ?>" class="btn btn-warning">Edit</a>
                            <a href="proses_data_mou_moa.php?proses=delete&id_hapus=<?= $dataMouMoa['id_mou_moa'] ?>"
                                class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data?')">Hapus</a>
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
        <div class="container mt-5">
             <h2 class="text-center">Form Mou / Moa</h2>
             <form action="proses_data_mou_moa.php?proses=insert" method="POST" enctype="multipart/form-data">

                    <!-- nomor mou/moa -->
                    <div class="mb-3">
                        <label for="no_mou_moa"> Nomor Mou/Moa</label>
                        <input type="text" name="no_mou_moa" id="no_mou_moa" class="form-control" required>
                    </div>

                    <!-- jenis kerjasama -->
                    <div class="mt-3 row">
                        <label for="jenis_kerjasama">Jenis Kerjasama</label>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jenis_kerjasama[]" id="mou" class="form-check-input"
                                    value="mou">
                                <label for="mou" class="form-check-label">MOU</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jenis_kerjasama[]" id="MOA" class="form-check-input"
                                    value="MOA">
                                <label for="MOA" class="form-check-label">MOA</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jenis_kerjasama[]" id="IA" class="form-check-input"
                                    value="IA">
                                <label for="IA" class="form-check-label">IA</label>
                            </div>
                     </div>

                    <!-- topik kerjasama -->
                    <div class="mb-3">
                        <label for="topik_kerjasama">Topik Kerjasama</label>
                        <input type="text" name="topik_kerjasama" id="topik_kerjasama" class="form-control" required>
                    </div>

                    <!-- jangka waktu -->
                    <div class="mb-3">
                        <label for="jangka_waktu">Jangka Waktu</label>
                        <input type="text" name="jangka_waktu" id="jangka_waktu" class="form-control" required>
                    </div>

                    <!-- awal kerjasama -->
                    <div class="mb-3">
                        <label for="awal_kerjasama">Awal Kerjasama</label>
                        <input type="date" name="awal_kerjasama" id="awal_kerjasama" class="form-control" required>
                    </div>

                    <!-- akhir kerjasama -->
                    <div class="mb-3">
                        <label for="akhir_kerjasama">Akhir Kerjasama</label>
                        <input type="date" name="akhir_kerjasama" id="akhir_kerjasama" class="form-control" required>
                    </div>

                    <!-- jurusan terkait -->
                    <div class="mt-3 row">
                        <label for="jurusan_terkait">Jurusan Terkait</label>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="teknologi-informasi" class="form-check-input"
                                    value="teknologi-informasi">
                                <label for="teknologi-informasi" class="form-check-label">Teknologi Informasi</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="teknik-mesin" class="form-check-input"
                                    value="teknik-mesin">
                                <label for="teknik-mesin" class="form-check-label">Teknik Mesin</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="teknik-sipil" class="form-check-input"
                                    value="teknik-sipil">
                                <label for="teknik-sipil" class="form-check-label">Teknik Sipil</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="teknik-elektro" class="form-check-input"
                                    value="teknik-elektro">
                                <label for="teknik-elektro" class="form-check-label">Teknik Elektro</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="administrasi-niaga" class="form-check-input"
                                    value="administrasi-niaga">
                                <label for="administrasi-niaga" class="form-check-label">Administrasi Niaga</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="akuntasi" class="form-check-input" value="akuntasi">
                                <label for="akuntasi" class="form-check-label">Akuntansi</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="bahasa-inggris" class="form-check-input" value="bahasa-inggris">
                                <label for="bahasa-inggris" class="form-check-label">bahasa-inggris</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="general" class="form-check-input" value="general">
                                <label for="general" class="form-check-label">General</label>
                            </div>
                     </div>

                    <!-- keterangan -->
                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <select name="keterangan" class="form-control" required>
                            <option value="">Pilih Keterangan</option>
                            <option value="1">Aktif</option>
                            <option value="2">Tidak Aktif</option>
                            <option value="3">Kadaluarsa</option>
                            <option value="4">Di Perpanjang</option>
                            <option value="5">Dalam Perpanjangan</option>
                        </select>
                    </div>

                    <!-- upload dokumen -->
                    <div class="mb-3">
                        <label for="file_dokumen" class="form-label">Upload Dokumen</label>
                        <input type="file" name="file_dokumen" id="file_dokumen" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>


        <?php
        break;

    case "edit":
        include "../../database/koneksi.php";
        $edit = mysqli_query($koneksi, "SELECT * FROM tb_mou_moa WHERE id_mou_moa = '$_GET[id_mou_moa]'");
        $dataMouMoa = mysqli_fetch_array($edit);
        $jurusan_terkait = explode(", ", $dataMouMoa['jurusan_terkait']);
        ?>


        <!-- edit data mou/moa -->
        <div class="conatiner mt-5">
            <h2 class="text-center">Edit Mou / Moa</h2>
            <form action="proses_data_mou_moa.php?proses=update" method="POST" enctype="multipart/form-data">

                <!-- ID -->
                <input type="number" name="id" id="id" class="form-control" value="<?= $dataMouMoa['id_mou_moa'] ?>" hidden>

                <!-- nomor mou/moa -->
                <div class="mb-3">
                    <label for="nomor-mou-moa">Nomor Mou/Moa</label>
                    <input type="text" name="nomor-mou-moa" id="nomor-mou-moa" class="from-control"
                        value="<?= $dataMouMoa['no_mou_moa'] ?>" required>
                </div>

                <!-- jenis kerjasama -->
                <div class="mb-3">
                    <label for="Jenis kerjasama">Jenis Kerjasama</label>
                    <input type="text" name="Jenis kerjasama" id="Jenis kerjasama" class="from-control"
                        value="<?= $dataMouMoa['jenis_kerjasama'] ?>" required>
                </div>

                <!-- topik kerjasama -->
                <div class="mb-3">
                    <label for="topik-kerjasama">Topik Kerjasama</label>
                    <input type="text" name="topik-kerjasama" id="topik-kerjasama" class="from-control"
                        value="<?= $dataMouMoa['topik_kerjasama'] ?>" required>
                </div>

                <!-- jangaka  waktu -->
                <div class="mb-3">
                    <label for="Jangka Waktu">Jangka Waktu</label>
                    <input type="text" name="Jangka Waktu" id="Jangka Waktu" class="from-control"
                        value="<?= $dataMouMoa['jangka_waktu'] ?>" required>
                </div>

                <!-- awal kerejasama -->
                <div class="mb-3">
                    <label for="awal kerjasama">Awal Kerjasama</label>
                    <input type="date" name="awal kerjasama" id="awal kerjasama" class="from-control"
                        value="<?= $dataMouMoa['awal_kerjasama'] ?>" required>
                </div>

                <!-- akhir kerjasama -->
                <div class="mb-3">
                    <label for="akhir kerjasama">Akhir Kerjasama</label>
                    <input type="date" name="akhir kerjasama" id="akhir kerjasama" class="from-control"
                        value="<?= $dataMouMoa['akhir_kerjasama'] ?>" required>
                </div>

                <!-- jurusan terkait -->
                <div class="mt-3 row">
                    <label for="jurusan-terkait">Jurusan Terkait</label>
                    <div class="form-check col-2">
                        <input type="checkbox" name="jurusan_terkait[]" id="teknologi-informasi" class="form-check-input"
                            value="teknologi-informasi" <?php if (in_array("teknologi-informasi", $jurusan_terkait))
                                echo "checked" ?>>
                            <label for="teknologi-informasi" class="form-check-label">Teknologi Informasi</label>
                        </div>
                        <div class="form-check col-2">
                            <input type="checkbox" name="jurusan_terkait[]" id="teknik-mesin" class="form-check-input"
                                value="teknik-mesin" <?php if (in_array("teknik-mesin", $jurusan_terkait))
                                echo "checked" ?>>
                            <label for="teknik-mesin" class="form-check-label">Teknik Mesin</label>
                        </div>
                        <div class="form-check col-2">
                            <input type="checkbox" name="jurusan_terkait[]" id="teknik-sipil" class="form-check-input"
                                value="teknik-sipil" <?php if (in_array("teknik-sipil", $jurusan_terkait))
                                echo "checked" ?>>
                            <label for="teknik-sipil" class="form-check-label">Teknik Sipil</label>
                        </div>
                        <div class="form-check col-2">
                            <input type="checkbox" name="jurusan_terkait[]" id="teknik-elektro" class="form-check-input"
                                value="teknik-elektro" <?php if (in_array("teknik-elektro", $jurusan_terkait))
                                echo "checked" ?>>
                            <label for="teknik-elektro" class="form-check-label">Teknik Elektro</label>
                        </div>
                        <div class="form-check col-2">
                            <input type="checkbox" name="jurusan_terkait[]" id="administrasi-niaga" class="form-check-input"
                                value="administrasi-niaga" <?php if (in_array("administrasi-niaga", $jurusan_terkait))
                                echo "checked" ?>>
                            <label for="administrasi-niaga" class="form-check-label">Administrasi Niaga</label>
                        </div>
                        <div class="form-check col-2">
                            <input type="checkbox" name="jurusan_terkait[]" id="akuntasi" class="form-check-input" value="akuntasi"
                            <?php if (in_array("akuntasi", $jurusan_terkait))
                                echo "checked" ?>>
                            <label for="akuntasi" class="form-check-label">Akuntansi</label>
                        </div>
                        <div class="form-check col-2">
                            <input type="checkbox" name="jurusan_terkait[]" id="bahasa-inggris" class="form-check-input"
                                value="bahasa-inggris" <?php if (in_array("bahasa-inggris", $jurusan_terkait))
                                echo "checked" ?>>
                            <label for="bahasa-inggris" class="form-check-label">Bahasa Inggris</label>
                        </div>
                        <div class="form-check col-2">
                            <input type="checkbox" name="jurusan_terkait[]" id="general" class="form-check-input" value="general"
                            <?php if (in_array("general", $jurusan_terkait))
                                echo "checked" ?>>
                            <label for="general" class="form-check-label">General</label>
                        </div>
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
                            <option value="<?= $row['id_mou_moa'] ?>"><?= $row['keterangan'] ?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>

                <!-- upload dokumen -->
                <div class="mb-3">
                    <label for="file" class="form-label">P</label>
                    <input type="file" name="file" id="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx"
                        value="<?= $dataMouMoa['file_dokumen'] ?>" required>
                </div>

            </form>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>

        </div>

        <?php
        break;
endswitch;
?>