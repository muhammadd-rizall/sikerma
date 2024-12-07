<?php

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "sikerma";

        $koneksi = mysqli_connect( $host, $user, $pass, $db );

        if(!$koneksi)
        {
            echo "gagal koneksi";
        }
        else 
        {
            echo "koneksi berhasil";
        }

?>