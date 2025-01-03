<?php
    if ($_GET['proses'] == "insert") {
        if (isset($_POST["submit"])) {
            include "../../database/koneksi.php";

            $jurusan_terkait = implode(",", $_POST['jurusan_terkait']);
            

            // Proses upload file dokumen
            if (isset($_FILES['file_dokumen']) && $_FILES['file_dokumen']['error'] == UPLOAD_ERR_OK) {
               $file_dokumen = $_FILES['file_dokumen']['name'];
               $target_dir = __DIR__ . "/../../upload/documents/";
               $target_file = $target_dir . basename($file_dokumen);

               if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);}
           
               if (move_uploaded_file($_FILES['file_dokumen']['tmp_name'], $target_file)) {
                   echo "File berhasil diunggah.";
               } else {
                   echo "Gagal mengunggah file.";
               }
               } else {
               $file_dokumen = ''; // Atau nilai default jika file tidak diunggah
               echo "File tidak ada atau gagal diunggah.";
           }
           


           $sql = mysqli_query($conn, "INSERT INTO tb_mou_moa (
            no_mou_moa, jenis_kerjasama, jangka_waktu, awal_kerjasama, 
            akhir_kerjasama, jurusan_terkait, topik_kerjasama, file_dokumen, id_mitra) 
            VALUES (
                '$_POST[no_mou_moa]', '$_POST[jenis_kerjasama]', '$_POST[jangka_waktu]', '$_POST[awal_kerjasama]', '$_POST[akhir_kerjasama]', '$jurusan_terkait', '$_POST[topik_kerjasama]', '$file_dokumen', '$_POST[id_mitra]'
            )");
        
             if($sql) {
                echo  "<script>window.location='../../../index.php?p=dataMouMoa'</script>";

            } else {
                echo "Gagal menyimpan data: " . mysqli_error($conn);
            }
        }
    }

        else if ($_GET['proses'] == "update") {
            if (isset($_POST['submit'])) {
                include "../../database/koneksi.php";

                
                // Periksa apakah $_POST['jurusan_terkait'] ada dan valid
                if (isset($_POST['jurusan_terkait']) && is_array($_POST['jurusan_terkait'])) {
                        $joined_jurusan = implode(',', $_POST['jurusan_terkait']);
                    } else {
                                $joined_jurusan = ''; // Set sebagai string kosong jika tidak valid
                            }
                            

                

                 // Proses upload file dokumen
            if (isset($_FILES['file_dokumen']) && $_FILES['file_dokumen']['error'] == UPLOAD_ERR_OK) {
                $file_dokumen = $_FILES['file_dokumen']['name'];
                $target_dir = __DIR__ . "/../../upload/documents/";
                $target_file = $target_dir . basename($file_dokumen);
 
                if (!is_dir($target_dir)) {
                 mkdir($target_dir, 0755, true);}
            
                if (move_uploaded_file($_FILES['file_dokumen']['tmp_name'], $target_file)) {
                    echo "File berhasil diunggah.";
                } else {
                    echo "Gagal mengunggah file.";
                }
                } else {
                $file_dokumen = ''; // Atau nilai default jika file tidak diunggah
                echo "File tidak ada atau gagal diunggah.";
            }
            

            $sql = mysqli_query($conn, "UPDATE tb_mou_moa SET 
            no_mou_moa = '$_POST[no_mou_moa]',
            jenis_kerjasama = '$_POST[jenis_kerjasama]',
            jangka_waktu = '$_POST[jangka_waktu]',
            awal_kerjasama = '$_POST[awal_kerjasama]',
            akhir_kerjasama = '$_POST[akhir_kerjasama]',
            jurusan_terkait = '$joined_jurusan',
            topik_kerjasama = '$_POST[topik_kerjasama]',
            file_dokumen = '$file_dokumen',
            id_mitra = '$_POST[id_mitra]'
            WHERE id_mou_moa = '$_POST[id_mou_moa]'");
        
        
                        if($sql) {
                            echo  "<script>window.location='../../../index.php?p=dataMouMoa'</script>";

                        } else {
                            echo "Gagal mengedit data   : " . mysqli_error($conn);
                        }
            }
        }

       
        elseif (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
            include '../../database/koneksi.php';
            $hapus = mysqli_query($conn, "DELETE FROM tb_mou_moa WHERE id_mou_moa = '$_GET[id_hapus]'") ;
            if ($hapus) {
                echo "<script>alert('Berhasil menghapus data');</script>";
                echo  "<script>window.location='../../../index.php?p=dataMouMoa'</script>";
            } else {
                echo "<script>alert('Gagal menghapus data');</script>";
            }
        }
?>