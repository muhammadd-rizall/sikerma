<?php
    if ($_GET['proses'] == "insert") {
        include "../../database/koneksi.php";
        if (isset($_POST["submit"])) {
            $sql = mysqli_query($koneksi, "INSERT INTO tb_mitra (
                                                        nama_instansi,
                                                        email_instansi,
                                                        bidang_usaha,
                                                        no_telp,
                                                        alamat_instansi,
                                                        kota,
                                                        provinsi,
                                                        negara,
                                                        website) 
                                                        VALUES('$_POST[nama_instansi]',
                                                        '$_POST[email_instansi]',
                                                        '$_POST[bidang_usaha]',
                                                        '$_POST[no_telp]',
                                                        '$_POST[alamat_instansi]',
                                                        '$_POST[kota]',
                                                        '$_POST[provinsi]',
                                                        '$_POST[negara]'
                                                        '$_POST[website]')");
            if ($sql) {
                echo "<script>window.location='index.php?p=matakuliah'</script>";
            }
        }
    }

        else if ($_GET['proses'] == "update") {
            include "../../database/koneksi.php";
            if (isset($_POST['submit'])) {
                $sql = mysqli_query($koneksi, "UPDATE tb_mitra SET 
                                        nama_instani = '$_POST[nama_instani]',
                                        email_instansi = '$_POST[email_instansi]',
                                        bidang_usaha = '$_POST[bidang_usaha]',
                                        no_telp = '$_POST[no_telp]',
                                        alamat_instansi = '$_POST[alamat_instansi]',
                                        kota = '$_POST[kota]',
                                        provinsi = '$_POST[provinsi]',
                                        negara = '$_POST[negara]',
                                        website = '$_POST[website]'
                                        WHERE id_mitra = '$_POST[id_mitra]'");
        
                if ($sql) {
                    echo "<script>window.location='index.php?p=matakuliah'</script>";
                }
            }
        }

        else if ($_GET['proses'] == "delete") {
            include '../../database/koneksi.php';
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_mitra WHERE id_mitra = '$_GET[id_mitra]'");
            if ($hapus) {
                echo "<script>window.location='index.php?p=matakuliah'</script>";
            }
        }
?>