<?php

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "coba11";

        $conn = mysqli_connect( $host, $user, $pass, $db );

        if (!$conn) {
            die('Koneksi ke database gagal: ' . mysqli_connect_error());
        }
        

        // if ($conn) {
        //     echo "Koneksi database berhasil.";
        // } else {
        //     die("Koneksi database gagal.");
        // }

        

?>