<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();

if(isset($_POST["username"]) ){
    include 'koneksi.php';
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $query = mysqli_query($db, "SELECT * FROM user WHERE username ='$username' AND password='$password'");

    if(mysqli_num_rows($query) == 1){
        $_SESSION['login'] = true; 
        $_SESSION['user'] = $username;
        $_SESSION['pw'] = $password;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: 'Username atau Password Salah'
        });</script>";
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signin Sikerma</title>
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      body {
        background: linear-gradient(0, #ff7e5f, #feb47b, #765285);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
              <h4>Login Sikerma</h4>
            </div>
            <div class="card-body">
              <form method="POST" action="" class="needs-validation" novalidate>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" required>
                  <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                  <label for="floatingPassword">Password</label>
                </div>
                <div class="form-check text-start mb-3">
                  <input class="form-check-input" type="checkbox" value="remember-me" id="rememberMe">
                  <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button class="btn btn-success w-100 py-2" type="submit">Login</button>
              </form>
              <p class="mt-3 text-center">
                Belum punya akun? <a href="Registrasi.php" class="text-decoration-none">Sign Up</a>
              </p>
            </div>
            <div class="card-footer text-muted text-center">
              &copy; <?= date("Y") ?> Sikerma
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
