<?php
    if ($_GET['proses'] == "insert") {
        include "../../database/koneksi.php";
        if (isset($_POST["submit"])) {
            $sql = mysqli_query($koneksi, "INSERT INTO tb_user (
                                                        nama,
                                                        username,
                                                        email,
                                                        password,
                                                        level_user) 
                                                        VALUES('$_POST[nama]',
                                                        '$_POST[username]',
                                                        '$_POST[email]',
                                                        '$_POST[password]',
                                                        '$_POST[level_user]')");
            if ($sql) {
                echo "<script>window.location='index.php?p=matakuliah'</script>";
            }
        }
    }

        else if ($_GET['proses'] == "update") {
            include "../../database/koneksi.php";
            if (isset($_POST['submit'])) {
                $sql = mysqli_query($koneksi, "UPDATE  tb_user SET 
                                        nama = '$_POST[nama]',
                                        username = '$_POST[username]',
                                        email = '$_POST[email]',
                                        password = '$_POST[password]',
                                        level_user = '$_POST[level_user]'
                                        WHERE id_mitra = '$_POST[id_user]'");
        
                if ($sql) {
                    echo "<script>window.location='index.php?p=matakuliah'</script>";
                }
            }
        }

        else if ($_GET['proses'] == "delete") {
            include '../../database/koneksi.php';
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_user = '$_GET[id_user]'");
            if ($hapus) {
                echo "<script>window.location='index.php?p=matakuliah'</script>";
            }
        }
?>