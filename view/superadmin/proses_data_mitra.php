<?php
    if ($_GET['proses'] == "insert") {
        if (isset($_POST["submit"])) {
            include "../../database/koneksi.php";
            $sql = mysqli_query($conn, "INSERT INTO tb_mitra (
                                                        nama_instansi,
                                                        email_instansi,
                                                        bidang_usaha,
                                                        no_telp,
                                                        alamat_instansi,
                                                        kota,
                                                        provinsi,
                                                        website) 
                                                        VALUES('$_POST[nama_instansi]',
                                                        '$_POST[email_instansi]',
                                                        '$_POST[bidang_usaha]',
                                                        '$_POST[no_telp]',
                                                        '$_POST[alamat_instansi]',
                                                        '$_POST[kota]',
                                                        '$_POST[provinsi]',
                                                        '$_POST[website]')");
            if($sql) {
                echo  "<script>window.location='../../../index.php?p=dataMitra'</script>";

            } else {
                echo "Gagal menyimpan data: " . mysqli_error($conn);
            }
        }
    }

        else if ($_GET['proses'] == "update") {
            if (isset($_POST['submit'])) {
                include "../../database/koneksi.php";
                $sql = mysqli_query($conn, "UPDATE tb_mitra SET 
                                        nama_instansi = '$_POST[nama_instansi]',
                                        email_instansi = '$_POST[email_instansi]',
                                        bidang_usaha = '$_POST[bidang_usaha]',
                                        no_telp = '$_POST[no_telp]',
                                        alamat_instansi = '$_POST[alamat_instansi]',
                                        kota = '$_POST[kota]',
                                        provinsi = '$_POST[provinsi]',
                                        website = '$_POST[website]'
                                        WHERE id_mitra = '$_POST[id_mitra]'");
        
                if($sql) {
                    echo  "<script>window.location='../../../index.php?p=dataMitra'</script>";

                } else {
                    echo "Gagal mengedit data   : " . mysqli_error($conn);
                }
            }
        }

        elseif (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
            include '../../database/koneksi.php';
            $hapus = mysqli_query($conn, "DELETE FROM tb_mitra WHERE id_mitra = '$_GET[id_hapus]'") ;
            if ($hapus) {
                echo "<script>alert('Berhasil menghapus data');</script>";
                echo  "<script>window.location='../../../index.php?p=dataMitra'</script>";
            } else {
                echo "<script>alert('Gagal menghapus data');</script>";
            }
        }
?>