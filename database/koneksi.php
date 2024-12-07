<?php

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "mi 2a";

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