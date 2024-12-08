<?php
    if ($_GET['proses'] == "insert") {
        include "../../database/koneksi.php";
        if (isset($_POST["submit"])) {
            $sql = mysqli_query($koneksi, "INSERT INTO tb_kegiatan_kerjasama (
                                                        kegiatan,
                                                        deskripsi_kegiatan,
                                                        dokumentasi) 
                                                        VALUES('$_POST[kegiatan]',
                                                        '$_POST[deskripsi_kegiatan]',
                                                        '$_POST[dokumentasi]')");
            if ($sql) {
                echo "<script>window.location='index.php?p=matakuliah'</script>";
            }
        }
    }

        else if ($_GET['proses'] == "update") {
            include "../../database/koneksi.php";
            if (isset($_POST['submit'])) {
                $sql = mysqli_query($koneksi, "UPDATE  tb_user SET 
                                        kegiatan = '$_POST[kegiatan]',
                                        deskripsi_kegiatan = '$_POST[deskripsi_kegiatan]',
                                        dokumentasi = '$_POST[dokumentasi]'");
        
                if ($sql) {
                    echo "<script>window.location='index.php?p=matakuliah'</script>";
                }
            }
        }

        else if ($_GET['proses'] == "delete") {
            include '../../database/koneksi.php';
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_kegiatan_kerjasama WHERE id_kegiatan = '$_GET[id_kegiatan]'");
            if ($hapus) {
                echo "<script>window.location='index.php?p=matakuliah'</script>";
            }
        }
?>