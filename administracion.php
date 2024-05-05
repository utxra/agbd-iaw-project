<?php
session_start();

if (isset($_POST['logout'])) {
    $_SESSION['admin'] = 0; // Eliminar la variable de sesión 'admin'
}

if ($_SESSION['admin'] == 0) {
    header("Location: ./index.php");
}
?>
<html lang="es">

<head>
    <!-- Required meta tagss for new branch -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./landing.css">
    <link rel="stylesheet" href="./responsive.css">
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
    <title>Página de administración - FJRA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/3b3dbab205.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container-fluid">
        <!-- header -->
        <nav class="navbar navbar-expand-lg netflix-padding-left netflix-padding-right">
            <div class="container-fluid">
                <div class="netflix-row">
                    <div class="left d-flex align-items-center">
                        <a class="navbar-brand" href="./index.php">
                            <img src="./images/logo.png" alt="">
                        </a>
                        <div class="netflix-nav">
                            <section>
                                <button><a href="./index.php">Home</a></button>
                                <button><a href="./peliculas.php">Peliculas</a></button>
                                <button><a href="./series.php">Series</a></button>
                            </section>
                        </div>
                    </div>
                    <div class="right d-flex align-items-center">
                        <i class="bi bi-search"></i>
                        <div class="netflix-dropdown-box dropdown">
                            <button class="netflix-dropdown " type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li class="dropdown-item">
                                    <?php
                                    if ($_SESSION['admin'] == 1) {
                                        echo '<form method="post" align="center" action="./administracion.php">
                                                    <button type="submit" name="logout" id="logout">Cerrar Sesión</button>
                                                </form>';
                                    } elseif ($_SESSION['admin'] == 0) {
                                        echo '<form method="post" align="center" action="./login_page">
                                                    <button type="submit" name="logout" id="logout">Cerrar Sesión</button>
                                                </form>';
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                        <a href="./login_page.php">
                            <section class="netflix-profile">
                                Administración
                            </section>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- /header -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 m-5 selector-admin">
                <div class="row-5 m-5">
                    <a class="btn btn-primary admin-button" href="./admin/insertar.php" target="admin-form">Insertar</a>
                </div>
                <div class="row-5 m-5">
                    <a class="btn btn-primary admin-button" href="./admin/eliminar.php" target="admin-form">Eliminar</a>                    
                </div>
                <div class="row-5 m-5">
                    <a class="btn btn-primary admin-button" href="./admin/actualizar.php" target="admin-form">Actualizar</a>
                </div>
                <div class="row-5 m-5">
                    <a class="btn btn-primary admin-button" href="./admin/backups.php" target="admin-form">Backups</a>
                </div>
            </div>
            <div class="col m-5">
                <iframe name="admin-form" src="./admin/welcome.php" style="width: 100%; height: 80vh; border: none;" scrolling="yes">

                </iframe>
            </div>
        </div>
    </div>
    <!-- sliders-end -->

    <!-- footer  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="./javaScript.js"></script>


</body>

</html>

<?php

?>