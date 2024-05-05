<?php
  session_start();
  
  if ($_SESSION['admin'] == 1) {
    header("Location: ./administracion.php");
  }

?>

<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Administración</title>
  <link rel="stylesheet" href="./style.css">
</head>

<body>

  <div class="login-top">
    <img src="./images/logo.png" alt="">
  </div>

  <div class="d-flex justify-content-center align-items-center" style="width: 100vw;">
    <section class="login-box">
      <h2 class="text-white">Iniciar sesión</h2>
      <form method="POST" action="./comprobacion.php" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3 bg-white rounded px-2">
          <label class="form-label small-text">Usuario</label>
          <input type="text" class="form-control border-0 p-0" name="usuario" id="usuario">
        </div>
        <div class="mb-3 bg-white rounded px-2">
          <label class="form-label small-text">Contraseña</label>
          <input type="password" class="form-control border-0 p-0" name="passwd" id="passwd">
          <label class="form-label small-text" style="color: red;"><?php 
            if (isset($_GET['error'])) {
              $credenciales = $_GET['error'];
              echo "Las credenciales no son correctas";
            }
          ?></label>
        </div>
        <button type="submit" class="btn btn-danger mt-3" style="width: 100%;">Sign In</button>
      </form>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>