<?php


// Ambil data dari formulir
$nama_instansi = $_POST['nama_instansi'];
$alamat = $_POST['alamat'];
$penandatangan = $_POST['penandatangan'];
$jabatan = $_POST['jabatan'];
$kontak_person = $_POST['kontak_person'];
$nomor_kontak = $_POST['nomor_kontak'];
$email = $_POST['email'];

// Upload file
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["dokumen"]["name"]);
if (move_uploaded_file($_FILES["dokumen"]["tmp_name"], $target_file)) {
    $dokumen = basename($_FILES["dokumen"]["name"]);
} else {
    die("Gagal mengupload file.");
}

// Simpan ke database
$sql = "INSERT INTO pengajuan (nama_instansi, alamat, penandatangan, jabatan, kontak_person, nomor_kontak, email, dokumen) 
        VALUES ('$nama_instansi', '$alamat', '$penandatangan', '$jabatan', '$kontak_person', '$nomor_kontak', '$email', '$dokumen')";

if (mysqli_query($conn, $sql)) {
    echo "Data berhasil disimpan. <a href='index.php'>Kembali</a>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
