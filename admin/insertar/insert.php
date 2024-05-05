<?php
session_start();

require '../../login.php';

$conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

if (!$conexion) {
    echo "Ha sido imposible conectarse a la base de datos";
}

if ($_SESSION['admin'] == 0) {
    header("Location: ../../index.php");
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
    <link rel="stylesheet" href="../../landing.css">
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
    <title>Página de administración - FJRA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/3b3dbab205.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container d-flex align-items-center vh-100">
        <form action="./insert.php?tabla=actores" method="post" enctype="multipart/form-data" class="w-100">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <table class="table table-dark table-hover" align="center" style="color: #fff">
                        <?php
                        if ($_GET['tabla'] == "actores") {
                            $insertar = mysqli_query($conexion, 'CALL insert_actores("' . $_POST['nombre'] . '")');
                            if (!$insertar) {
                                echo "Error en la consulta: " . mysqli_error($conexion);
                            } else {
                                while ($row = mysqli_fetch_assoc($insertar)) {
                                    echo '
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                    </tr>
                                    <tr>
                                        <td>' . $row['idactores'] . '</td>
                                        <td>' . $row['nombre'] . '</td>
                                    </tr>';
                                }
                            }
                        }

                        if ($_GET['tabla'] == "categorias") {
                            $insertar = mysqli_query($conexion, 'CALL insert_categorias("' . $_POST['nombre'] . '")');
                            if (!$insertar) {
                                echo "Error en la consulta: " . mysqli_error($conexion);
                            } else {
                                while ($row = mysqli_fetch_assoc($insertar)) {
                                    echo '
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                    </tr>
                                    <tr>
                                        <td>' . $row['idcategoria'] . '</td>
                                        <td>' . $row['nombre'] . '</td>
                                    </tr>';
                                }
                            }
                        }

                        if ($_GET['tabla'] == "categorias_pelis") {
                            $insertar = mysqli_query($conexion, 'CALL insert_categorias_pelis(' . $_POST['idpelicula'] . ',' . $_POST['idcategoria'] . ')');
                            if (!$insertar) {
                                echo "Error en la consulta: " . mysqli_error($conexion);
                            } else {
                                while ($row = mysqli_fetch_assoc($insertar)) {
                                    echo '
                                    <tr>
                                        <th>ID Película</th>
                                        <th>Título</th>
                                        <th>ID Categoría</th>
                                        <th>Nombre</th>
                                    </tr>
                                    <tr>
                                        <td>' . $row['idpelicula'] . '</td>
                                        <td>' . $row['titulo'] . '</td>
                                        <td>' . $row['idcategoria'] . '</td>
                                        <td>' . $row['nombre'] . '</td>
                                    </tr>';
                                }
                            }
                        }

                        if ($_GET['tabla'] == "categorias_series") {
                            $insertar = mysqli_query($conexion, 'CALL insert_categorias_series(' . $_POST['idserie'] . ',' . $_POST['idcategoria'] . ')');
                            if (!$insertar) {
                                echo "Error en la consulta: " . mysqli_error($conexion);
                            } else {
                                while ($row = mysqli_fetch_assoc($insertar)) {
                                    echo '
                                    <tr>
                                        <th>ID Serie</th>
                                        <th>Título</th>
                                        <th>ID Categoría</th>
                                        <th>Nombre</th>
                                    </tr>
                                    <tr>
                                        <td>' . $row['idserie'] . '</td>
                                        <td>' . $row['titulo'] . '</td>
                                        <td>' . $row['idcategoria'] . '</td>
                                        <td>' . $row['nombre'] . '</td>
                                    </tr>';
                                }
                            }
                        }

                        if ($_GET['tabla'] == "episodios") {
                            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                                $imagen_temporal = $_FILES['imagen']['tmp_name'];
                                $imagen_binaria = file_get_contents($imagen_temporal);
                            } else {
                                echo "Error al subir la imagen.";
                                exit;
                            }

                            $insertar = mysqli_query($conexion, 'INSERT INTO episodios (idtemporada, sinopsis, duracion, nombre, video, imagen) VALUES (' . $_POST['idtemporada'] . ', "' . $_POST['sinopsis'] . '", ' . $_POST['duracion'] . ', "' . $_POST['nombre'] . '", "' . $_POST['video'] . '", "' . mysqli_real_escape_string($conexion, $imagen_binaria) . '")');

                            if (!$insertar) {
                                echo "Error en la consulta: " . mysqli_error($conexion);
                            } else {
                                $mostrar = mysqli_query($conexion, 'SELECT * FROM episodios ORDER BY idepisodio desc LIMIT 1');
                                while ($row = mysqli_fetch_assoc($mostrar)) {
                                    echo '
                                        <tr>
                                            <th>ID episodio</th>
                                            <th>ID temporada</th>
                                            <th>Sinopsis</th>
                                            <th>Duracion</th>
                                            <th>Nombre</th>
                                        </tr>
                                        <tr>
                                            <td>' . $row['idepisodio'] . '</td>
                                            <td>' . $row['idtemporada'] . '</td>
                                            <td>' . $row['sinopsis'] . '</td>
                                            <td>' . $row['duracion'] . '</td>
                                            <td>' . $row['nombre'] . '</td>
                                        </tr>';
                                }
                            }
                        }


                        if ($_GET['tabla'] == "peliculas") {
                            $insertar = mysqli_query($conexion, 'INSERT INTO peliculas (titulo,sinopsis,video,duracion,año,director,imagen) VALUES ("' . $_POST['titulo'] . '", "' . $_POST['sinopsis'] . '", "' . $_POST['video'] . '", ' . $_POST['duracion'] . ', ' . $_POST['año'] . ', "' . $_POST['director'] . '", "' . $_POST['imagen'] . '")');
                            if (!$insertar) {
                                echo "Error en la consulta: " . mysqli_error($conexion);
                            } else {
                                $mostrar = mysqli_query($conexion, 'SELECT * FROM peliculas ORDER BY idpelicula desc LIMIT 1');
                                while ($row = mysqli_fetch_assoc($mostrar)) {
                                    echo '
                                        <tr>
                                            <th>ID Película</th>
                                            <th>Título</th>
                                            <th>Sinopsis</th>
                                            <th>Duracion</th>
                                            <th>Año</th>
                                            <th>Director</th>
                                        </tr>
                                        <tr>
                                            <td>' . $row['idpelicula'] . '</td>
                                            <td>' . $row['titulo'] . '</td>
                                            <td>' . $row['sinopsis'] . '</td>
                                            <td>' . $row['duracion'] . '</td>
                                            <td>' . $row['año'] . '</td>
                                            <td>' . $row['director'] . '</td>
                                        </tr>';
                                }
                            }
                        }

                        if ($_GET['tabla'] == "reparto_pelis") {
                            $insertar = mysqli_query($conexion, 'INSERT INTO reparto_pelis (idpelicula,idactor) VALUES (' . $_POST['idpelicula'] . ',' . $_POST['idactores'] . ')');
                            $consulta = mysqli_query($conexion, 'SELECT peliculas.idpelicula,peliculas.titulo,reparto_pelis.idreparto,actores.nombre FROM reparto_pelis,actores,peliculas WHERE peliculas.idpelicula=reparto_pelis.idpelicula AND actores.idactores=reparto_pelis.idactor ORDER BY reparto_pelis.idreparto desc LIMIT 1');

                            if (!$consulta) {
                                echo "Error en la consulta: " . mysqli_error($conexion);
                            } else {
                                while ($row = mysqli_fetch_assoc($consulta)) {
                                    echo '
                                    <tr>
                                        <th>ID Película</th>
                                        <th>Título</th>
                                        <th>ID Reparto</th>
                                        <th>Nombre</th>
                                    </tr>
                                    <tr>
                                        <td>' . $row['idpelicula'] . '</td>
                                        <td>' . $row['titulo'] . '</td>
                                        <td>' . $row['idreparto'] . '</td>
                                        <td>' . $row['nombre'] . '</td>
                                    </tr>';
                                }
                            }
                        }

                        if ($_GET['tabla'] == "reparto_series") {
                            $insertar = mysqli_query($conexion, 'INSERT INTO reparto_series (idserie,idactor) VALUES (' . $_POST['idserie'] . ',' . $_POST['idactores'] . ')');
                            $consulta = mysqli_query($conexion, 'SELECT series.idserie,series.titulo,reparto_series.idreparto,actores.nombre FROM reparto_series,actores,series WHERE series.idserie=reparto_series.idserie AND actores.idactores=reparto_series.idactor ORDER BY reparto_series.idreparto desc LIMIT 1');

                            if (!$consulta) {
                                echo "Error en la consulta: " . mysqli_error($conexion);
                            } else {
                                while ($row = mysqli_fetch_assoc($consulta)) {
                                    echo '
                                    <tr>
                                        <th>ID Serie</th>
                                        <th>Título</th>
                                        <th>ID Reparto</th>
                                        <th>Nombre</th>
                                    </tr>
                                    <tr>
                                        <td>' . $row['idserie'] . '</td>
                                        <td>' . $row['titulo'] . '</td>
                                        <td>' . $row['idreparto'] . '</td>
                                        <td>' . $row['nombre'] . '</td>
                                    </tr>';
                                }
                            }
                        }

                        if ($_GET['tabla'] == "series") {
                            $insertar = mysqli_query($conexion, 'INSERT INTO series (titulo, sinopsis, año_salida, año_fin, director, imagen) VALUES ("' . $_POST['titulo'] . '", "' . $_POST['sinopsis'] . '", ' . $_POST['año_salida'] . ', ' . $_POST['año_fin'] . ', "' . $_POST['director'] . '", "' . $_POST['imagen'] . '")');
                            if (!$insertar) {
                                echo "Error en la consulta: " . mysqli_error($conexion);
                            } else {
                                $mostrar = mysqli_query($conexion, 'SELECT * FROM series ORDER BY idserie desc LIMIT 1');
                                while ($row = mysqli_fetch_assoc($mostrar)) {
                                    echo '
                                        <tr>
                                            <th>ID Serie</th>
                                            <th>Título</th>
                                            <th>Sinopsis</th>
                                            <th>Año de salida</th>
                                            <th>Año de fin</th>
                                            <th>Director</th>
                                        </tr>
                                        <tr>
                                            <td>' . $row['idserie'] . '</td>
                                            <td>' . $row['titulo'] . '</td>
                                            <td>' . $row['sinopsis'] . '</td>
                                            <td>' . $row['año_salida'] . '</td>
                                            <td>' . $row['año_fin'] . '</td>
                                            <td>' . $row['director'] . '</td>
                                        </tr>';
                                }
                            }
                        }

                        if ($_GET['tabla'] == "temporadas") {
                            $insertar = mysqli_query($conexion, 'INSERT INTO temporadas (idserie,sinopsis,orden) VALUES (' . $_POST['idserie'] . ', "' . $_POST['sinopsis'] . '", ' . $_POST['orden'] . ')');
                            if (!$insertar) {
                                echo "Error en la consulta: " . mysqli_error($conexion);
                            } else {
                                $mostrar = mysqli_query($conexion, 'SELECT temporadas.*,series.titulo FROM temporadas,series WHERE temporadas.idserie=series.idserie ORDER BY idtemporada desc LIMIT 1');
                                while ($row = mysqli_fetch_assoc($mostrar)) {
                                    echo '
                                        <tr>
                                            <th>ID Temporada</th>
                                            <th>Título</th>
                                            <th>Sinopsis</th>
                                            <th>Orden</th>
                                        </tr>
                                        <tr>
                                            <td>' . $row['idtemporada'] . '</td>
                                            <td>' . $row['titulo'] . '</td>
                                            <td>' . $row['sinopsis'] . '</td>
                                            <td>' . $row['orden'] . '</td>
                                        </tr>';
                                }
                            }
                        }

                        ?>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="./javaScript.js"></script>


</body>

</html>

<?php
mysqli_close($conexion);
?>