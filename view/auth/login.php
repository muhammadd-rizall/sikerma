<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../public/assets/css/pages.css">

  <title>Login</title>


</head>

<body>

  <div class="container">
    <!-- Image Section -->
    <div class="image">
    <img src="../../public/assets/img/pnp.png" alt="Logo PNP" class="logo" />
    <h1>Login</h1>
    <form>
      <div class="mb-3">
        <input
          type="text"
          class="form-control"
          id="username"
          placeholder="Username"
          aria-label="Username"
          required />
      </div>

      <div class="mb-3">
        <input
          type="password"
          class="form-control"
          id="password"
          placeholder="Password"
          aria-label="Password"
          required />
      </div>
      
      <button type="submit" class="btn btn-login w-100">Login</button>
      <p class="mt-3">
        <a href="#" class="signup-link">Don't have an account? Sign Up</a>
      </p>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>