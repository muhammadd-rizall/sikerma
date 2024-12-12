<?php
    if ($_GET['proses'] == "insert") {
        if (isset($_POST["submit"])) {
            include "../../database/koneksi.php";

            if (isset($_FILES['dokumentasi']) && $_FILES['dokumentasi']['error'] == UPLOAD_ERR_OK) {
                $file_temp = $_FILES['dokumentasi']['name'];
                $target_dir = __DIR__ . "/../../upload/img/";
                $target_file = $target_dir . basename($file_temp);
 
                if (!is_dir($target_dir)) {
                 mkdir($target_dir, 0755, true);}
            
                if (move_uploaded_file($_FILES['dokumentasi']['tmp_name'], $target_file)) {
                    echo "File berhasil diunggah.";
                } else {
                    echo "Gagal mengunggah file.";
                }
                } else {
                $file_temp = ''; // Atau nilai default jika file tidak diunggah
                echo "File tidak ada atau gagal diunggah.";
            }

            $sql = mysqli_query($conn, "INSERT INTO tb_kegiatan_kerjasama (
                                                        kegiatan,
                                                        deskripsi_kegiatan,
                                                        dokumentasi,id_mou_moa) 
                                                        VALUES('$_POST[kegiatan]',
                                                        '$_POST[deskripsi_kegiatan]',
                                                        '$file_temp','$_POST[id_mou_moa]')");
            if($sql) {
                echo  "<script>window.location='../../../index.php?p=dataKegiatan'</script>";

            } else {
                echo "Gagal menyimpan data: " . mysqli_error($conn);
            }
        }
    }

        else if ($_GET['proses'] == "update") {
            if (isset($_POST['submit'])) {
                include "../../database/koneksi.php";

                if (isset($_FILES['dokumentasi']) && $_FILES['dokumentasi']['error'] == UPLOAD_ERR_OK) {
                    $file_temp = $_FILES['dokumentasi']['name'];
                    $target_dir = __DIR__ . "/../../upload/img/";
                    $target_file = $target_dir . basename($file_temp);
     
                    if (!is_dir($target_dir)) {
                     mkdir($target_dir, 0755, true);}
                
                    if (move_uploaded_file($_FILES['dokumentasi']['tmp_name'], $target_file)) {
                        echo "File berhasil diunggah.";
                    } else {
                        echo "Gagal mengunggah file.";
                    }
                    } else {
                    $file_temp = ''; // Atau nilai default jika file tidak diunggah
                    echo "File tidak ada atau gagal diunggah.";
                    }

                    $sql = mysqli_query($conn, "UPDATE  tb_kegiatan_kerjasama SET 
                                        kegiatan = '$_POST[kegiatan]',
                                        deskripsi_kegiatan = '$_POST[deskripsi_kegiatan]',
                                        dokumentasi = '$file_temp',
                                        id_mou_moa = '$_POST[id_mou_moa]' 
                                        WHERE id_kegiatan = '$_POST[id_kegiatan]'");
                    
                    if($sql) {
                        echo  "<script>window.location='../../../index.php?p=dataKegiatan'</script>";
        
                    } else {
                        echo "Gagal menyimpan data: " . mysqli_error($conn);
                    }
        }
     }
     

     elseif (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
        include '../../database/koneksi.php';
        $hapus = mysqli_query($conn, "DELETE FROM tb_kegiatan_kerjasama WHERE id_kegiatan = '$_GET[id_hapus]'") ;
        if ($hapus) {
            echo "<script>alert('Berhasil menghapus data');</script>";
            echo  "<script>window.location='../../../index.php?p=dataKegiatan'</script>";
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    }
?>