<?php
session_start();

if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = 0;
}

require 'login.php';

$conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

if (!$conexion) {
    echo "Ha sido imposible conectarse a la base de datos";
}

$info_serie = "SELECT idserie,titulo,sinopsis,imagen,año_salida,año_fin,num_temporadas_serie(idserie) as num_temporadas FROM series LIMIT 5";

$query_series = mysqli_query($conexion, $info_serie);

$info_peli = "SELECT idpelicula,titulo,imagen,video,año,duracion,sinopsis,director FROM peliculas LIMIT 5";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./landing.css">
    <link rel="stylesheet" href="./responsive.css">
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
    <title>Página principal - FJRA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <script src="https://kit.fontawesome.com/3b3dbab205.js" crossorigin="anonymous"></script>

</head>

<body>

    <div style="position: relative;">
        <!-- header -->
        <nav class="navbar navbar-expand-lg netflix-navbar netflix-padding-left netflix-padding-right">
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
                            <button class="netflix-dropdown " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
        <!-- /header -->


        <!-- video -->
        <div class="">
            <section class="netflix-home-video">
                <div class="top"></div>
                <div class="bottom"></div>
                <video src="./video/chicken_video.mp4" autoplay muted loop></video>
                <div class="content">
                    <section class="left">
                        <img src="./images/chicken_run_logo.webp" alt="">

                        <div class="d-flex mt-2">
                            <a href="./reproductor.php?pelicula_id=1"><button class="btn btn-light m-2"> <i class="bi bi-play-fill" style="color: black; padding: 0%;"></i>
                                    Reproducir </button></a>
                        </div>
                    </section>

                </div>
            </section>

        </div>
        <!-- video -->

        <!-- sliders -->
        <div>
            <div class="container-fluid slider">
                <section class="d-flex justify-content-between margin-right">
                    <p class="text-white"> <b>Películas</b> </p>
                </section>
                <div class="d-flex">
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
                  <div class="card" style="width: 400px;">
                    <img src="' . $row['imagen'] . '" class="card-img-top"  alt="...">
                    <div class="card-body">
                        <section class="d-flex justify-content-between">
                        <div>
                            <a href="./reproductor.php?pelicula_id=' . $row['idpelicula'] . '"><i class="bi bi-play-circle-fill card-icon"></i></a>
                            <button class="bi bi-info-circle card-icon" style="color: black;" id="btn-abrir-info-peliculas-' . $row['idpelicula'] . '"></button>
                            <dialog id="info-peliculas-' . $row['idpelicula'] . '" class="info">
                            <div class="">
                                <section class="netflix-home-video">
                                    <button class="btn-close btn-close-white btn-cerrar-info" id="btn-cerrar-info-peliculas-' . $row['idpelicula'] . '"></button>
                                    <img src="' . $row['imagen'] . '" style="width: 100%;">
                                    <div class="bottom"></div>
                                    <div class="content">
                                    <section class="left">
                                        <h1 style="margin-top: 80%;" class="info-titulo">' . $row['titulo'] . '</h1>
                                        <div class="d-flex mt-2">
                                        <a href="./reproductor.php?pelicula_id=' . $row['idpelicula'] . '"><button class="btn btn-light m-2"> <i class="bi bi-play-fill" style="color: black; padding: 0%;"></i>
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
                    const btnAbrirInfo_pelis_' . $row['idpelicula'] . ' = document.querySelector("#btn-abrir-info-peliculas-' . $row['idpelicula'] . '");
                    const btnCerrarInfo_pelis_' . $row['idpelicula'] . ' = document.querySelector("#btn-cerrar-info-peliculas-' . $row['idpelicula'] . '");
                    const info_pelis_' . $row['idpelicula'] . ' = document.querySelector("#info-peliculas-' . $row['idpelicula'] . '");
          
                    btnAbrirInfo_pelis_' . $row['idpelicula'] . '.addEventListener("click", () => {
                        info_pelis_' . $row['idpelicula'] . '.showModal();
                    })
          
                    btnCerrarInfo_pelis_' . $row['idpelicula'] . '.addEventListener("click", () => {
                        info_pelis_' . $row['idpelicula'] . '.close();
                    })
                </script>';
                    }
                    ?>
                </div>
                <br>
                <section class="d-flex justify-content-between margin-right">
                    <p class="text-white"> <b>Series</b> </p>
                </section>
                <div class="" data-bs-ride="carousel">
                    <div>
                        <div class="d-flex">
                            <?php
                            while ($row = mysqli_fetch_array($query_series)) {
                                $reparto_series = "SELECT actores.nombre FROM reparto_series INNER JOIN actores ON reparto_series.idactor = actores.idactores WHERE reparto_series.idserie = " . $row['idserie'];

                                $categorias_series = "SELECT categorias.nombre FROM categorias_series INNER JOIN categorias ON categorias_series.idcategoria = categorias.idcategoria WHERE categorias_series.idserie = " . $row['idserie'];

                                $resultado_reparto_series = mysqli_query($conexion, $reparto_series);

                                $resultado_categorias_series = mysqli_query($conexion, $categorias_series);

                                $año = $row['año_salida'] . ' - ' . $row['año_fin'];

                                $categorias = "";

                                $reparto = "";

                                while ($categoria = mysqli_fetch_array($resultado_categorias_series)) {
                                    $categorias .= $categoria['nombre'] . " • ";
                                }

                                $categorias = rtrim($categorias, " • ");

                                while ($actor = mysqli_fetch_array($resultado_reparto_series)) {
                                    $reparto .= $actor['nombre'] . ", ";
                                }

                                $reparto = rtrim($reparto, ", ");

                                $año_formato = rtrim($año, " - ");;

                                echo '
                <div class="card" style="width: 400px;">
                    <img src="' . $row['imagen'] . '" class="card-img-top"  alt="...">
                    <div class="card-body">
                        <section class="d-flex justify-content-between">
                        <div>
                            <button class="bi bi-info-circle card-icon" style="color: black;" id="btn-abrir-info-series-' . $row['idserie'] . '"></button>
                            <dialog id="info-series-' . $row['idserie'] . '" class="info">
                            <div class="">
                                <section class="netflix-home-video">
                                    <button class="btn-close btn-close-white btn-cerrar-info" id="btn-cerrar-info-series-' . $row['idserie'] . '"></button>
                                    <img src="' . $row['imagen'] . '" style="width: 100%;">
                                    <div class="bottom"></div>
                                    <div class="content">
                                    <section class="left">
                                        <h1 style="margin-top: 80%;" class="info-titulo">' . $row['titulo'] . '</h1>
                                    </section>
                                    </div>
                                </section>
                            </div>
                            <div class="info-contenido m-5 row">
                                <div class="col d-flex align-items-center">
                                    <h1>Sinopsis</h1>
                                    <div class="duracion">Año ' . $año_formato . '</div>
                                </div>
                                <div>
                                    <p style="text-align: justify;">' . $row['sinopsis'] . '</p>
                                    <p><b>Reparto: </b> ' . $reparto . ' , etc.</p>
                                </div>';

                                echo '<div class="col d-flex align-items-center"><h1>Episodios: </h1>
                                <div class="duracion">
                                <select id="selector-temporadas-' . $row['idserie'] . '"></div>';

                                $temporadas_query = 'SELECT idtemporada,orden,num_episodios_temporada(idtemporada) as num_episodios FROM temporadas WHERE idserie = ' . $row['idserie'];

                                $resultado_temporadas = mysqli_query($conexion, $temporadas_query);

                                while ($temporada = mysqli_fetch_array($resultado_temporadas)) {
                                    echo '<option value="' . $temporada['idtemporada'] . '">Temporada ' . $temporada['orden'] . ' (' . $temporada['num_episodios'] . ' Episodio/s)</option>';
                                }

                                echo '</select></div>    
                                        </div>';
                                echo '<div id="episodios-container-' . $row['idserie'] . '"></div>';

                                echo '</dialog>
                        
                            </div>
                        <div>
                          <a href="" download><i class="bi bi-arrow-down-circle card-icon"></i></a>
                        </div>
                      </section>
                      <h1 style="color: white; font-size: 1.75rem;">' . $row['titulo'] . ' <i style="color: white; font-size: 1rem;">' . $row['num_temporadas'] . ' Seasons</i></h1>
                      <section class="d-flex align-items-center justify-content-between">
                        <p class="netflix-card-text m-0" style="color: rgb(0, 186, 0);">97% de coincidencia</p>
                        <span class="m-2 netflix-card-text text-white">' . $categorias . ' </span> <span
                          class="border netflix-card-text p-1 text-white">HD</span>
                      </section>
                    </div>
                </div>';
                                echo '
                <script>
                    const btnAbrirInfo_series_' . $row['idserie'] . ' = document.querySelector("#btn-abrir-info-series-' . $row['idserie'] . '");
                    const btnCerrarInfo_series_' . $row['idserie'] . ' = document.querySelector("#btn-cerrar-info-series-' . $row['idserie'] . '");
                    const info_series_' . $row['idserie'] . ' = document.querySelector("#info-series-' . $row['idserie'] . '");
        
                    btnAbrirInfo_series_' . $row['idserie'] . '.addEventListener("click", () => {
                        info_series_' . $row['idserie'] . '.showModal();
                    })
        
                    btnCerrarInfo_series_' . $row['idserie'] . '.addEventListener("click", () => {
                        info_series_' . $row['idserie'] . '.close();
                    })
                </script>
                <script>
                    $(document).ready(function() {
                        // Seleccionar el primer elemento del selector de temporadas
                        var primerTemporada = $("#selector-temporadas-' . $row['idserie'] . ' option:first").val();
                        
                        // Cargar automáticamente los episodios de la primera temporada
                        cargarEpisodios(primerTemporada);
                    
                        // Función para cargar los episodios de una temporada específica
                        function cargarEpisodios(idTemporada) {
                            $.ajax({
                                type: "POST",
                                url: "obtener_episodios.php", // Archivo PHP para obtener los episodios
                                data: { idtemporada: idTemporada },
                                success: function(response) {
                                    $("#episodios-container-' . $row['idserie'] . '").html(response);
                                }
                            });
                        }
                    
                        // Manejar el cambio en el selector de temporadas
                        $("#selector-temporadas-' . $row['idserie'] . '").change(function() {
                            var idTemporada = $(this).val();
                            cargarEpisodios(idTemporada);
                        });
                    });                
                </script>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="./javaScript.js"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.slider-pelis').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });
        });
    </script>

</body>

</html>

<?php
mysqli_close($conexion);
?>