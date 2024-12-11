<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();

if (isset($_POST["username"])) {
    include "../../database/koneksi.php";
    $username = $_POST["username"];
    $password = md5($_POST["password"]); // Menggunakan md5 untuk enkripsi password
    $level_user = $_POST["level_user"] ?? null;

    // Query untuk mencari username dan password
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");

    // Mengecek apakah data ditemukan
    if (mysqli_num_rows($query) == 1) {
        $row = mysqli_fetch_assoc($query); // Mengambil data pengguna
        $_SESSION['login'] = true; 
        $_SESSION['user'] = $username;
        $_SESSION['level_user'] = $row['level_user']; // Menyimpan level_user dari database
        $_SESSION['pw'] = $password; // Menyimpan password untuk referensi, meskipun tidak terlalu aman

        // Redireksi ke halaman dashboard atau halaman yang sesuai
        header("Location: /index.php");
        exit();
    } else {
        echo "<script>alert('Login Gagal')</script>"; // Menampilkan pesan jika login gagal
    }
}
?>






<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>

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
  <body>
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
              <input type="password" class="form-control" placeholder="Password" name="password" required>
              <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-gradient w-100 btn-lg" type="submit">Sign in</button>
            <p class="mt-3 text-center">
              Belum punya akun? 
              <a href="../auth/register.php" class="text-decoration-none">Sign Up</a>
            </p>
          </form>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
