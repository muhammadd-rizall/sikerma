<?php
    if ($_GET['proses'] == "insert") {
        include "../../database/koneksi.php";
        if (isset($_POST["submit"])) {

            $password = md5($_POST['password']);
            $sql = mysqli_query($conn, "INSERT INTO tb_user (
                                                        nama,
                                                        username,
                                                        email,
                                                        password,
                                                        level_user) 
                                                        VALUES('$_POST[nama]',
                                                        '$_POST[username]',
                                                        '$_POST[email]',
                                                        '$password',
                                                        '$_POST[level_user]')");
            if($sql) {
                echo  "<script>window.location='../../../index.php?p=user'</script>";

            } else {
                echo "Gagal menyimpan data: " . mysqli_error($conn);
            }
        }
    }

        else if ($_GET['proses'] == "update") {
            include "../../database/koneksi.php";
            if (isset($_POST['submit'])) {

                if (!empty($_POST['password'])) {
                    $password = md5($_POST['password']);
                } else {
                    // Jika tidak diisi, biarkan password tetap sama
                    $password = $_POST['old_password'];  // Asumsikan Anda sudah mengirimkan password lama dalam form
                }

                $sql = mysqli_query($conn, "UPDATE  tb_user SET 
                                        nama = '$_POST[nama]',
                                        username = '$_POST[username]',
                                        email = '$_POST[email]',
                                        password = '$password',
                                        level_user = '$_POST[level_user]'
                                        WHERE id_user = '$_POST[id_user]'");
        
        if($sql) {
            echo  "<script>window.location='../../../index.php?p=user'</script>";

        } else {
            echo "Gagal menyimpan data: " . mysqli_error($conn);
        }
            }
        }

        elseif (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
            include '../../database/koneksi.php';
            $hapus = mysqli_query($conn, "DELETE FROM tb_user WHERE id_user = '$_GET[id_hapus]'") ;
            if ($hapus) {
                echo "<script>alert('Berhasil menghapus data');</script>";
                echo  "<script>window.location='../../../index.php?p=user'</script>";
            } else {
                echo "<script>alert('Gagal menghapus data');</script>";
            }
        }
?>