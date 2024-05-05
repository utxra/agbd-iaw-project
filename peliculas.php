<?php
session_start();

require 'login.php';

$conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

if (!$conexion) {
    echo "Ha sido imposible conectarse a la base de datos";
}

$info_peli = "SELECT idpelicula,titulo,imagen,video,sinopsis,duracion,año FROM peliculas";

$resultado = mysqli_query($conexion, $info_peli);

$i = 0;

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
    <title>Página principal - FJRA</title>
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
                                                <button type="submit" name="signin" id="sigin">Iniciar Sesión</button>
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
    <div class="secondary-panel container-fluid mt-5">
        <?php
        while ($row = mysqli_fetch_array($resultado)) {
            $reparto_pelis = "SELECT actores.nombre FROM reparto_pelis INNER JOIN actores ON reparto_pelis.idactor = actores.idactores WHERE reparto_pelis.idpelicula = " . $row['idpelicula'];

            $categorias_pelis = "SELECT categorias.nombre FROM categorias_pelis INNER JOIN categorias ON categorias_pelis.idcategoria = categorias.idcategoria WHERE categorias_pelis.idpelicula = " . $row['idpelicula'];

            $resultado_reparto_pelis = mysqli_query($conexion, $reparto_pelis);

            $resultado_categorias_pelis = mysqli_query($conexion, $categorias_pelis);

            $categorias = "";

            $reparto = "";

            while ($categoria = mysqli_fetch_array($resultado_categorias_pelis)) {
                $categorias .= $categoria['nombre'] . " • ";
            }

            $categorias = rtrim($categorias, " • ");

            while ($actor = mysqli_fetch_array($resultado_reparto_pelis)) {
                $reparto .= $actor['nombre'] . ", ";
            }

            $reparto = rtrim($reparto, ", ");

            echo '
                  <div class="card">
                    <img src="' . $row['imagen'] . '" class="card-img-top"  alt="...">
                    <div class="card-body">
                        <section class="d-flex justify-content-between">
                        <div>
                            <a href="./reproductor.php?pelicula_id=' . $row['idpelicula'] . '"><i class="bi bi-play-circle-fill card-icon"></i></a>
                            <button class="bi bi-info-circle card-icon" style="color: black;" id="btn-abrir-info-' . $row['idpelicula'] . '"></button>
                            <dialog id="info-' . $row['idpelicula'] . '" class="info">
                            <div class="">
                                <section class="netflix-home-video">
                                    <button class="btn-close btn-close-white btn-cerrar-info" id="btn-cerrar-info-' . $row['idpelicula'] . '"></button>
                                    <img src="' . $row['imagen'] . '" style="width: 100%;">
                                    <div class="bottom"></div>
                                    <div class="content">
                                    <section class="left">
                                        <h1 style="margin-top: 80%;" class="info-titulo">' . $row['titulo'] . '</h1>
                                        <div class="d-flex mt-2">
                                        <a href="./reproductor.php?pelicula_id='. $row['idpelicula'] .'"><button class="btn btn-light m-2"> <i class="bi bi-play-fill" style="color: black; padding: 0%;"></i>
                                            Reproducir </button></a>
                                        </div>
                                    </section>
                                    </div>
                                </section>
                            </div>
                            <div class="info-contenido m-5 row">
                                <div class="col d-flex align-items-center">
                                    <h1>Sinopsis</h1>
                                    <div class="duracion">Año ' . $row['año'] . ' ' . $row['duracion'] . ' min</div>
                                </div>
                                <div>
                                    <p style="text-align: justify;">' . $row['sinopsis'] . '</p>
                                    <p><b>Reparto: </b> ' . $reparto . ' , etc.</p>
                                </div>
                            </div>
                            </dialog>
                        </div>
                        <div>
                          <a href="" download><i class="bi bi-arrow-down-circle card-icon"></i></a>
                        </div>
                      </section>
                      <h1 style="color: white; font-size: 1.75rem;">' . $row['titulo'] . '</h1>
                      <section class="d-flex align-items-center justify-content-between">
                        <p class="netflix-card-text m-0" style="color: rgb(0, 186, 0);">97% de coincidencia</p>
                        <span class="m-2 netflix-card-text text-white">' . $categorias . ' </span> <span
                          class="border netflix-card-text p-1 text-white">HD</span>
                      </section>
                    </div>
                  </div>';
            echo '
                <script>
                    const btnAbrirInfo_' . $row['idpelicula'] . ' = document.querySelector("#btn-abrir-info-' . $row['idpelicula'] . '");
                    const btnCerrarInfo_' . $row['idpelicula'] . ' = document.querySelector("#btn-cerrar-info-' . $row['idpelicula'] . '");
                    const info_' . $row['idpelicula'] . ' = document.querySelector("#info-' . $row['idpelicula'] . '");
          
                    btnAbrirInfo_' . $row['idpelicula'] . '.addEventListener("click", () => {
                        info_' . $row['idpelicula'] . '.showModal();
                    })
          
                    btnCerrarInfo_' . $row['idpelicula'] . '.addEventListener("click", () => {
                        info_' . $row['idpelicula'] . '.close();
                    })
                </script>';
        }
        ?>
    </div>
    <!-- sliders-end -->

    <!-- footer  -->
    <div class="container footer">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="row">
                    <div class="col-md-3">
                        <ul>
                            <li>Audio and Subtitle</li>
                            <li>Media Center</li>
                            <li>Privacy</li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul>
                            <li>Audio description</li>
                            <li>Investor Relation</li>
                            <li>Terms and Conditions</li>
                            <li>Legal Notices</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul>
                            <li>Help Center</li>
                            <li>Jobs</li>

                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul>
                            <li>Gift card</li>
                            <li>Subscription</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-10 mx-auto">
                <div class="row">

                    <div class="col">
                        <p class="copy-right">@netflix copyright</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="./javaScript.js"></script>

    <?php
    while ($row = mysqli_fetch_array($resultado)) {

    }
    ?>

</body>

</html>

<?php
mysqli_close($conexion);
?>