<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/assets/css/pages.css">

    <title>Register</title>
</head>
<body>
<div class="register-container">
  <div class="image">
      <img src="../../public/assets/img/pnp.png" alt="Logo PNP" class="logo" />
        <h1>Register</h1>
              <form method="POST">
              <div class="mb-3">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required />
              </div>
              <div class="mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
              </div>
              <button type="submit" class="btn btn-register w-100">Register</button>
              <p class="mt-3">
                <a href="#" class="login-link">Already have an account? Login</a>
              </p>
              </form>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>