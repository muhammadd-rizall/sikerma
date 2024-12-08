<?php
    if ($_GET['proses'] == "insert") {
        include "../../database/koneksi.php";

        $jurusan_terkait = implode(",", $_POST['jurusan_terkait']);

         // Proses upload file dokumen
            $file_dokumen = $_FILES['file_dokumen']['name'];
            $target_dir = "upload/documents/";
            $target_file = $target_dir . basename($file_dokumen);
            move_uploaded_file($_FILES['file_dokumen']['tmp_name'], $target_file);


        if (isset($_POST["submit"])) {
            $sql = mysqli_query($koneksi, "INSERT INTO tb_mou_moa (
                                                        no_mou_moa,
                                                        jenis_kerjasama,
                                                        topik_kerjasama,
                                                        jangka_waktu,
                                                        awal_kerjasama,
                                                        akhir_kerjasama,
                                                        jurusan_terkait,
                                                        keterangan,
                                                        file_dokumen) 
                                                        VALUES('$_POST[no_mou_moa]',
                                                        '$_POST[jenis_kerjasama]',
                                                        '$_POST[topik_kerjasama]',
                                                        '$_POST[jangka_waktu]',
                                                        '$_POST[awal_kerjasama]',
                                                        '$_POST[akhir_kerjasama]',
                                                        '$jurusan_terkait,
                                                        '$_POST[keterangan]',
                                                        '$file_dokumen')");
            if ($sql) {
                echo "<script>window.location='index.php?p=matakuliah'</script>";
            }
        }
    }

        else if ($_GET['proses'] == "update") {
            include "../../database/koneksi.php";

            $jurusan_terkait = implode(","$_POST['jurusan_terkait']);

            if (isset($_POST['submit'])) {
                $sql = mysqli_query($koneksi, "UPDATE tb_mou_moa SET 
                                        no_mou_moa = '$_POST[no]',
                                        jenis_kerjasama = '$_POST[jenis_kerjasama]',
                                        jangka_waktu = '$_POST[jangka_waktu]',
                                        awal_kerjasama = '$_POST[awal_kerjasama]',
                                        akhir_kerjasama = '$_POST[akhir_kerjasama]',
                                        keterangan = '$_POST[keterangan]',
                                        jurusan_terkait = '$jurusan_terkait',
                                        topik_kerjasama = '$_POST[topik_kerjasama]',
                                        file_dokumen = '$file_dokumen'
                                        WHERE id_mou_moa = '$_POST[id_mou_moa]'");
        
                if ($sql) {
                    echo "<script>window.location='index.php?p=matakuliah'</script>";
                }
            }
        }

        else if ($_GET['proses'] == "delete") {
            include '../../database/koneksi.php';
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_mou_moa WHERE id_mou_moa = '$_GET[id_hapus]'");
            if ($hapus) {
                echo "<script>window.location='index.php?p=matakuliah'</script>";
            }
        }
?>