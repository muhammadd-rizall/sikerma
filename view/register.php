<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>Register</title>
  <style>
    body {
      background-image: url("assets/background.png");
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #fa802f;
    }

    .register-container {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    h1 {
      color: white;
      margin-bottom: 20px;
      font-family: "Georgia", serif;
    }

    .form-control {
      border-radius: 25px;
      padding: 10px 20px;
      background-color: #f9f9f9;
    }

    .btn-register {
      border-radius: 25px;
      padding: 10px 20px;
      background-color: #0066cc;
      color: white;
      border: none;
      font-weight: bold;
    }

    .btn-register:hover {
      background-color: #005bb5;
    }

    .login-link {
      color: #00bfff;
      text-decoration: none;
    }

    .login-link:hover {
      text-decoration: underline;
    }

    .logo {
      width: 100px;
      height: auto;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="register-container">
    <img src="../public/assets/img/pnp.png" alt="Logo PNP" class="logo" />
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
