<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signin Template · Bootstrap v5.3</title>

    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background: linear-gradient(0deg, #ff7e5f, #feb47b, #765285);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .card {
        border: none;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease-in-out;
      }
      .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
      }
      .form-floating input {
        border-radius: 20px;
        padding: 10px 20px;
      }
      .btn-gradient {
        background: #ff7e5f;
        color: #fff;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        font-size: 16px;
        transition: all 0.3s ease-in-out;
      }
      .btn-gradient:hover {
        background: #feb47b;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transform: scale(1.05);
      }
    </style>
  </head>
  <body class="d-flex align-items-center justify-content-center vh-100">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

          <?php
            session_start();

            if (isset($_POST["username"])) {
                include "../../database/koneksi.php";

                // Mengambil data dari form
                $username = mysqli_real_escape_string($conn, $_POST["username"]);
                $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
                $email = mysqli_real_escape_string($conn, $_POST["email"]);
                $password = md5(mysqli_real_escape_string($conn, $_POST["password"]));

                // Level default sebagai 'mitra'
                $level = 'mitra';

                // Query untuk menyimpan data ke tabel tb_user
                $query = "INSERT INTO tb_user (username, nama, email, password, level_user) 
                          VALUES ('$username', '$nama', '$email', '$password', '$level')";

                // Eksekusi query dan cek apakah berhasil
               // Periksa apakah email atau username sudah ada
                $cekEmailQuery = "SELECT * FROM tb_user WHERE email = '$email' OR username = '$username'";
                $result = mysqli_query($conn, $cekEmailQuery);

                if (mysqli_num_rows($result) > 0) {
                    // Jika ditemukan duplikasi
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Registrasi Gagal!',
                            text: 'Email atau Username sudah digunakan. Gunakan yang lain.',
                        });
                    </script>";
                } else {
                    // Jika tidak ada duplikasi, lanjutkan menyimpan data
                    $query = "INSERT INTO tb_user (username, nama, email, password, level_user) 
                              VALUES ('$username', '$nama', '$email', '$password', '$level')";

                    if (mysqli_query($conn, $query)) {
                        echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Registrasi Berhasil!',
                                text: 'Silakan login untuk melanjutkan.',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '../auth/login.php';
                                }
                            });
                        </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Registrasi Gagal!',
                                text: 'Terjadi kesalahan saat menyimpan data. Coba lagi.',
                            });
                        </script>";
                    }
                }

            }
        ?>
  <main class="form-signin w-100 m-auto">
      <div class="card" style="max-width: 400px; margin: auto;">
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <img src="../../public/assets/img/pnp.png" alt="Logo" class="img-fluid" style="max-width: 100px;">
          </div>
          <h3 class="text-center mb-4">Welcome Back</h3>
          <form method="POST" action="">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" placeholder="Username" name="username" required>
              <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" placeholder="nama" name="nama" required>
              <label for="floatingInput">Nama</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" placeholder="email" name="email" required>
              <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password" required>
              <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-gradient w-100 btn-lg" type="submit">Sign Up</button>
            

            <p class="mt-3 text-center">
              Masuk
              <a href="../auth/login.php" class="text-decoration-none">Sign In</a>
            </p>
        


          </form>
        </div>
        
      </div>
    </main>

        
        
      </form>
    </main>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>