<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi):
    case "list":
        ?>
                
                    <h2 class="mt-3">Data Mou/Moa</h2>
                            <a href="?p=dataMouMoa&aksi=input" class="btn-add mt-4 mb-4"><i class="fa-sharp fa-solid fa-plus"></i> Data MOU/MOA</a>
                            <table id="tabel-mou-moa" class="table table-bordered table-striped mt-5">
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
                                include ("../sikerma/database/koneksi.php");




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
                                                <?php
                                                $fileDokumen = $dataMouMoa['file_dokumen'];

                                                // Cek apakah tautan berasal dari Google Drive
                                                if (strpos($fileDokumen, 'drive.google.com') !== false): ?>
                                                    <!-- Tampilkan tombol untuk membuka di Google Drive -->
                                                    <a href="<?= htmlspecialchars($fileDokumen); ?>" target="_blank" class="btn btn-sm btn-primary" ><i class="fa fa-eye"></i></a>
                                                <?php else: ?>
                                                    <!-- Tampilkan tombol untuk dokumen lokal -->
                                                    <a href="/upload/documents/<?= htmlspecialchars($fileDokumen); ?>" target="_blank" class="btn btn-sm btn-primary" Download><i class="fa fa-eye"></i></a>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-nowrap">
                                                <a href="../../index.php?p=dataMouMoa&aksi=edit&id_edit=<?= $dataMouMoa['id_mou_moa'] ?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="/view/superadmin/proses_data_mou_moa.php?proses=delete&id_hapus=<?= $dataMouMoa['id_mou_moa'] ?>"
                                                    class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')"><i
                                                    class="bi bi-trash"></i></a>

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
            include ("../sikerma/database/koneksi.php");
            $mitraQuery = mysqli_query($conn, "SELECT id_mitra, nama_instansi FROM tb_mitra");
        ?>


        <!-- form tambah data Mou/moa -->
        <div class="container" >
             <h2 class="text-center">Form Mou / Moa</h2>
                <form action="../view/superadmin/proses_data_mou_moa.php?proses=insert" method="POST" enctype="multipart/form-data">
                    
                    <!-- nomor mou/moa -->
                    <div class="mb-3">
                        <label for="no_mou_moa"> Nomor Mou/Moa</label>
                        <input type="text" name="no_mou_moa" id="no_mou_moa" class="form-control" required>
                    </div>

                    <!-- jenis kerjasama -->
                    <div class="mt-3 row">
                        <label for="jenis_kerjasama">Jenis Kerjasama</label>
                            <div class="form-check col-2">
                                <input type="radio" name="jenis_kerjasama" id="mou" class="form-check-input"
                                    value="mou">
                                <label for="mou" class="form-check-label">MOU</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="radio" name="jenis_kerjasama" id="MOA" class="form-check-input"
                                    value="MOA">
                                <label for="MOA" class="form-check-label">MOA</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="radio" name="jenis_kerjasama" id="IA" class="form-check-input"
                                    value="IA">
                                <label for="IA" class="form-check-label">IA</label>
                            </div>
                     </div>

                     <div class="mb-3">
                        <label for="id_mitra">Pilih Mitra</label>
                        <select name="id_mitra" id="id_mitra" class="form-control" required>
                            <option value="">--Pilih Mitra--</option>
                            <?php while ($mitra = mysqli_fetch_array($mitraQuery)): ?>
                                <option value="<?= $mitra['id_mitra'] ?>"><?= $mitra['nama_instansi'] ?></option>
                            <?php endwhile; ?>
                        </select>
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
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                            <option value="Kadaluarsa">Kadaluarsa</option>
                            <option value="Diperpanjang">Di Perpanjang</option>
                            <option value="Dalam Perpanjangan">Dalam Perpanjangan</option>
                        </select>
                    </div>

                    <!-- upload dokumen -->
                    <div class="mb-3">
                        <label for="file_dokumen" class="form-label">Upload Dokumen</label>
                        <input type="file" name="file_dokumen" id="file_dokumen" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx" required>
                    </div>

                    <button type="submit" name="submit" class="btn-submit">Submit</button>
                </form>
            </div>


        <?php
        break;

    case "edit":
        include '../sikerma/database/koneksi.php';
        $edit = mysqli_query($conn, "SELECT * FROM tb_mou_moa WHERE id_mou_moa = '$_GET[id_edit]'");
        $dataMouMoa = mysqli_fetch_array($edit);
        $jurusan_terkait = explode(", ", $dataMouMoa['jurusan_terkait']);
        $mitraQuery = mysqli_query($conn, "SELECT id_mitra, nama_instansi FROM tb_mitra");

        
        

        ?>


        <!-- edit data mou/moa -->
        <div class="container mt-5">
             <h2 class="text-center">EDIT FORM MOU/MOA</h2>
                <form action="../view/superadmin/proses_data_mou_moa.php?proses=update" method="POST" enctype="multipart/form-data">
                   
                    <!-- ID -->
                    <input type="number" name="id_mou_moa" id="id_mou_moa" class="form-control" value="<?= $dataMouMoa['id_mou_moa'] ?>" hidden>

                    
                    <!-- nomor mou/moa -->
                    <div class="mb-3">
                        <label for="no_mou_moa"> Nomor Mou/Moa</label>
                        <input type="text" name="no_mou_moa" id="no_mou_moa" class="form-control" value="<?= $dataMouMoa['no_mou_moa'] ?>" required>
                    </div>

                    <!-- jenis kerjasama -->
                    <div class="mt-3 row">
                        <label for="jenis_kerjasama">Jenis Kerjasama</label>
                            <div class="form-check col-2">
                                <input type="radio" name="jenis_kerjasama" id="MOU" class="form-check-input"
                                    value="MOU" <?= ($dataMouMoa['jenis_kerjasama'] == 'MOU') ? 'checked' : '' ?>>
                                <label for="MOU" class="form-check-label">MOU</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="radio" name="jenis_kerjasama" id="MOA" class="form-check-input"
                                    value="MOA" <?= ($dataMouMoa['jenis_kerjasama'] == 'MOA') ? 'checked' : '' ?>>
                                <label for="MOA" class="form-check-label">MOA</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="radio" name="jenis_kerjasama" id="IA" class="form-check-input"
                                    value="IA" <?= ($dataMouMoa['jenis_kerjasama'] == 'IA') ? 'checked' : '' ?>>
                                <label for="IA" class="form-check-label">IA</label>
                            </div>
                     </div>

                     <div class="mb-3">
                        <label for="id_mitra">Pilih Mitra</label>
                        <select name="id_mitra" id="id_mitra" class="form-control" required>
                            <option value="">--Pilih Mitra--</option>
                            <?php
                                $mitraQuery = mysqli_query($conn, "SELECT id_mitra, nama_instansi FROM tb_mitra");
                                while ($mitra = mysqli_fetch_array($mitraQuery)): 
                            ?>
                                <option value="<?= $mitra['id_mitra'] ?>" <?= $dataMouMoa['id_mitra'] == $mitra['id_mitra'] ? 'selected' : '' ?>>
                                    <?= $mitra['nama_instansi'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>


                    <!-- topik kerjasama -->
                    <div class="mb-3">
                        <label for="topik_kerjasama">Topik Kerjasama</label>
                        <input type="text" name="topik_kerjasama" id="topik_kerjasama" class="form-control" value="<?= $dataMouMoa['topik_kerjasama'] ?>" required>
                    </div>

                    <!-- jangka waktu -->
                    <div class="mb-3">
                        <label for="jangka_waktu">Jangka Waktu</label>
                        <input type="text" name="jangka_waktu" id="jangka_waktu" class="form-control" value="<?= $dataMouMoa['jangka_waktu'] ?>" required>
                    </div>

                    <!-- awal kerjasama -->
                    <div class="mb-3">
                        <label for="awal_kerjasama">Awal Kerjasama</label>
                        <input type="date" name="awal_kerjasama" id="awal_kerjasama" class="form-control" value="<?= $dataMouMoa['awal_kerjasama'] ?>" required>
                    </div>

                    <!-- akhir kerjasama -->
                    <div class="mb-3">
                        <label for="akhir_kerjasama">Akhir Kerjasama</label>
                        <input type="date" name="akhir_kerjasama" id="akhir_kerjasama" class="form-control" value="<?= $dataMouMoa['akhir_kerjasama'] ?>" required>
                    </div>

                    <!-- jurusan terkait -->
                    <div class="mt-3 row">
                        <label for="jurusan_terkait">Jurusan Terkait</label>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="teknologi-informasi" class="form-check-input"
                                    value="teknologi informasi" <?php if (in_array("teknologi informasi", $jurusan_terkait)) echo "checked" ?>>
                                <label for="teknologi-informasi" class="form-check-label">Teknologi Informasi</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="teknik-mesin" class="form-check-input"
                                    value="teknik mesin" <?php if (in_array("teknik mesin", $jurusan_terkait)) echo "checked" ?>>
                                <label for="teknik-mesin" class="form-check-label">Teknik Mesin</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="teknik-sipil" class="form-check-input"
                                    value="teknik sipil" <?php if (in_array("teknik sipil", $jurusan_terkait)) echo "checked" ?>>
                                <label for="teknik-sipil" class="form-check-label">Teknik Sipil</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="teknik-elektro" class="form-check-input"
                                    value="teknik elektro" <?php if (in_array("teknik elektro", $jurusan_terkait)) echo "checked" ?>>
                                <label for="teknik-elektro" class="form-check-label">Teknik Elektro</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="administrasi-niaga" class="form-check-input"
                                    value="administrasi niaga" <?php if (in_array("administrasi niaga", $jurusan_terkait)) echo "checked" ?>>
                                <label for="administrasi-niaga" class="form-check-label">Administrasi Niaga</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="akuntasi" class="form-check-input" value="akuntasi" <?php if (in_array("akuntasi", $jurusan_terkait)) echo "checked" ?>>
                                <label for="akuntasi" class="form-check-label">Akuntansi</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="bahasa-inggris" class="form-check-input" value="bahasa inggris" <?php if (in_array("bahasa inggris", $jurusan_terkait)) echo "checked" ?>>
                                <label for="bahasa-inggris" class="form-check-label">bahasa inggris</label>
                            </div>
                            <div class="form-check col-2">
                                <input type="checkbox" name="jurusan_terkait[]" id="general" class="form-check-input" value="general" <?php if (in_array("general", $jurusan_terkait)) echo "checked" ?>> 
                                <label for="general" class="form-check-label">General</label>
                            </div>
                     </div>
                     

                    <!-- keterangan -->
                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <select name="keterangan" class="form-control" required>
                                <option value="">Pilih Keterangan</option>
                                <?php
                                        $pilihan = ["Aktif", "Tidak Aktif", "Kadaluarsa", "Di Perpanjang","Dalam Perpanjangan"];
                                        $selected_pil = isset($dataMouMoa['keterangan']) ? $dataMouMoa['keterangan'] : '';

                                        foreach ($pilihan as $pil) {
                                        $selected = ($pil === $selected_pil) ? "selected" : "";

                                        echo "<option value='" . htmlspecialchars($pil) . "' $selected>" . htmlspecialchars($pil) . "</option>";
                                        }
                                            ?>
                            </select>
                    </div>

                    <!-- upload dokumen -->
                    <div class="mb-3">
                        <label for="file_dokumen" class="form-label">Upload Dokumen</label>
                        <input type="file" name="file_dokumen" id="file_dokumen" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx" required>
                    </div>


                    <button type="submit" name="submit" class="btn-submit">Submit</button>
                </form>
            </div>

        <?php
        break;
        endswitch;
        ?>