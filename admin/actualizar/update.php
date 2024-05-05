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
        <form action="./consulta.php?tabla=<?php echo $_GET['tabla'] ?>" method="post" enctype="multipart/form-data"
            class="w-100">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <table class="table table-dark table-hover" align="center" style="color: #fff">
                        <?php
                        if ($_GET['tabla'] == "actores") {
                            $consulta = mysqli_query($conexion, 'SELECT * FROM ' . $_GET['tabla'] . ' WHERE idactores="' . $_POST['idactor'] . '"');
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo '  <tr>
                                            <td>ID actor: </td>
                                            <td><input type="number" name="idactor" id="idactor" value="' . $row['idactores'] . '" readonly></td>
                                        </tr>';
                                echo '  <tr>
                                        <td>Nombre: </td>
                                        <td><input type="text" name="nombre" id="nombre" value="' . $row['nombre'] . '"></td>
                                    </tr>';
                            }
                        }

                        if ($_GET['tabla'] == "categorias") {
                            $consulta = mysqli_query($conexion, 'SELECT * FROM ' . $_GET['tabla'] . ' WHERE idcategoria="' . $_POST['idcategoria'] . '"');
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo '  <tr>
                                        <td>ID: </td>
                                        <td><input type="number" name="idcategoria" id="idcategoria" value="' . $row['idcategoria'] . '"></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>Nombre: </td>
                                        <td><input type="text" name="nombre" id="nombre" value="' . $row['nombre'] . '"></td>
                                    </tr>';
                            }
                        }

                        if ($_GET['tabla'] == "categorias_pelis") {
                            $consulta = mysqli_query($conexion, 'SELECT categorias_pelis.id,categorias_pelis.idpelicula,categorias_pelis.idcategoria,peliculas.titulo,categorias.nombre FROM categorias_pelis,peliculas,categorias WHERE categorias_pelis.idpelicula=peliculas.idpelicula AND categorias_pelis.idcategoria=categorias.idcategoria AND categorias_pelis.id=' . $_POST['id']);
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo '  <tr>
                                        <td>ID: </td>
                                        <td><input type="text" name="id" id="id" value="' . $row['id'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>ID película: </td>
                                        <td><input type="text" name="idpelicula" id="pelicula" value="' . $row['idpelicula'] . '" ></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>Título: </td>
                                        <td><input type="text" name="titulo" id="titulo" value="' . $row['titulo'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                    <td>ID Categoría: </td>
                                    <td><input type="text" name="idcategoria" id="idcategoria" value="' . $row['idcategoria'] . '" ></td>
                                </tr>';
                                echo '  <tr>
                                    <td>Categoría: </td>
                                    <td><input type="text" name="nombre" id="nombre" value="' . $row['nombre'] . '" readonly></td>
                                </tr>';
                            }
                        }

                        if ($_GET['tabla'] == "categorias_series") {
                            $consulta = mysqli_query($conexion, 'SELECT categorias_series.id,series.titulo,series.idserie,categorias.nombre,categorias.idcategoria FROM categorias_series,series,categorias WHERE categorias_series.idserie=series.idserie AND categorias_series.idcategoria=categorias.idcategoria AND categorias_series.id=' . $_POST['id']);
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo '  <tr>
                                        <td>ID: </td>
                                        <td><input type="text" name="id" id="id" value="' . $row['id'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>ID Serie: </td>
                                        <td><input type="text" name="idserie" id="idserie" value="' . $row['idserie'] . '" ></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>Título: </td>
                                        <td><input type="text" name="titulo" id="titulo" value="' . $row['titulo'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                    <td>ID Categoría: </td>
                                    <td><input type="text" name="idcategoria" id="idcategoria" value="' . $row['idcategoria'] . '" ></td>
                                </tr>';
                                echo '  <tr>
                                    <td>Categoría: </td>
                                    <td><input type="text" name="nombre" id="nombre" value="' . $row['nombre'] . '" readonly></td>
                                </tr>';
                            }
                        }

                        if ($_GET['tabla'] == "episodios") {
                            $consulta = mysqli_query($conexion, 'SELECT idepisodio,idtemporada,sinopsis,duracion,nombre,video,orden FROM episodios WHERE idepisodio=' . $_POST['idepisodio']);
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo '  <tr>
                                        <td>ID: </td>
                                        <td><input type="number" name="idepisodio" id="idepisodio" value="' . $row['idepisodio'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>ID Temporada: </td>
                                        <td><input type="number" name="idtemporada" id="idtemporada" value="' . $row['idtemporada'] . '" ></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>Sinopsis: </td>
                                        <td><textarea type="text" name="sinopsis" id="sinopsis">' . $row['sinopsis'] . '</textarea></td>
                                    </tr>';
                                echo '  <tr>
                                    <td>Duracion (min): </td>
                                    <td><input type="text" name="duracion" id="duracion" value="' . $row['duracion'] . '"></td>
                                </tr>';
                                echo '  <tr>
                                        <td>Nombre: </td>
                                        <td><input type="text" name="nombre" id="nombre" value="' . $row['nombre'] . '"></td>
                                    </tr>';
                                echo '  <tr>
                                    <td>Vídeo: </td>
                                    <td><input type="text" name="video" id="video" value="' . $row['video'] . '"></td>
                                </tr>';
                                echo '  <tr>
                                    <td>Orden: </td>
                                    <td><input type="text" name="orden" id="orden" value="' . $row['orden'] . '"></td>
                                </tr>';

                            }
                        }

                        if ($_GET['tabla'] == "peliculas") {
                            $consulta = mysqli_query($conexion, 'SELECT idpelicula,titulo,sinopsis,video,duracion,año,director,imagen FROM peliculas WHERE idpelicula=' . $_POST['idpelicula']);
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo '  <tr>
                                        <td>ID: </td>
                                        <td><input type="number" name="idpelicula" id="idpelicula" value="' . $row['idpelicula'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>Título: </td>
                                        <td><input type="text" name="titulo" id="titulo" value="' . $row['titulo'] . '" ></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>Sinopsis: </td>
                                        <td><textarea type="text" name="sinopsis" id="sinopsis">' . $row['sinopsis'] . '</textarea></td>
                                    </tr>';
                                echo '  <tr>
                                    <td>Vídeo: </td>
                                    <td><input type="text" name="video" id="video" value="' . $row['video'] . '"></td>
                                </tr>';
                                echo '  <tr>
                                        <td>Duracion: </td>
                                        <td><input type="number" name="duracion" id="duracion" value="' . $row['duracion'] . '"></td>
                                    </tr>';
                                echo '  <tr>
                                    <td>Año: </td>
                                    <td><input type="number" name="año" id="año" value="' . $row['año'] . '"></td>
                                </tr>';
                                echo '  <tr>
                                <td>Director: </td>
                                <td><input type="text" name="director" id="director" value="' . $row['director'] . '"></td>
                            </tr>';
                                echo '  <tr>
                                <td>Imagen (Link): </td>
                                <td><input type="text" name="imagen" id="imagen" value="' . $row['imagen'] . '"></td>
                            </tr>';
                            }
                        }

                        if ($_GET['tabla'] == "reparto_pelis") {
                            $consulta = mysqli_query($conexion, 'SELECT reparto_pelis.idreparto,reparto_pelis.idpelicula,reparto_pelis.idactor,peliculas.titulo,actores.nombre FROM reparto_pelis,peliculas,actores WHERE reparto_pelis.idpelicula=peliculas.idpelicula AND reparto_pelis.idactor=actores.idactores AND reparto_pelis.idreparto=' . $_POST['idreparto']);
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo '  <tr>
                                        <td>ID: </td>
                                        <td><input type="text" name="idreparto" id="idreparto" value="' . $row['idreparto'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>ID película: </td>
                                        <td><input type="text" name="idpelicula" id="idpelicula" value="' . $row['idpelicula'] . '" ></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>Título: </td>
                                        <td><input type="text" name="titulo" id="titulo" value="' . $row['titulo'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                    <td>ID Actor: </td>
                                    <td><input type="text" name="idactor" id="idactor" value="' . $row['idactor'] . '" ></td>
                                </tr>';
                                echo '  <tr>
                                    <td>Actor: </td>
                                    <td><input type="text" name="nombre" id="nombre" value="' . $row['nombre'] . '" readonly></td>
                                </tr>';
                            }
                        }

                        if ($_GET['tabla'] == "reparto_series") {
                            $consulta = mysqli_query($conexion, 'SELECT reparto_series.idreparto,reparto_series.idserie,reparto_series.idactor,series.titulo,actores.nombre FROM reparto_series,series,actores WHERE reparto_series.idserie=series.idserie AND reparto_series.idactor=actores.idactores AND reparto_series.idreparto=' . $_POST['idreparto']);
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo '  <tr>
                                        <td>ID: </td>
                                        <td><input type="text" name="idreparto" id="idreparto" value="' . $row['idreparto'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>ID película: </td>
                                        <td><input type="text" name="idserie" id="idserie" value="' . $row['idserie'] . '" ></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>Título: </td>
                                        <td><input type="text" name="titulo" id="titulo" value="' . $row['titulo'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                    <td>ID Actor: </td>
                                    <td><input type="text" name="idactor" id="idactor" value="' . $row['idactor'] . '" ></td>
                                </tr>';
                                echo '  <tr>
                                    <td>Actor: </td>
                                    <td><input type="text" name="nombre" id="nombre" value="' . $row['nombre'] . '" readonly></td>
                                </tr>';
                            }
                        }

                        if ($_GET['tabla'] == "series") {
                            $consulta = mysqli_query($conexion, 'SELECT idserie,titulo,sinopsis,año_salida,año_fin,director,imagen FROM series WHERE idserie=' . $_POST['idserie']);
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo '  <tr>
                                        <td>ID: </td>
                                        <td><input type="number" name="idserie" id="idserie" value="' . $row['idserie'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>Título: </td>
                                        <td><input type="text" name="titulo" id="titulo" value="' . $row['titulo'] . '" ></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>Sinopsis: </td>
                                        <td><textarea type="text" name="sinopsis" id="sinopsis">' . $row['sinopsis'] . '</textarea></td>
                                    </tr>';
                                echo '  <tr>
                                    <td>Año salida: </td>
                                    <td><input type="number" name="año_salida" id="año_salida" value="' . $row['año_salida'] . '"></td>
                                </tr>';
                                echo '  <tr>
                                    <td>Año fin: </td>
                                    <td><input type="number" name="año_fin" id="año_fin" value="' . $row['año_fin'] . '"></td>
                                </tr>';
                                echo '  <tr>
                                    <td>Director: </td>
                                    <td><input type="text" name="director" id="director" value="' . $row['director'] . '"></td>
                                </tr>';
                                echo '  <tr>
                                        <td>Imagen (Link): </td>
                                        <td><input type="text" name="imagen" id="imagen" value="' . $row['imagen'] . '"></td>
                                    </tr>';
                            }
                        }

                        if ($_GET['tabla'] == "temporadas") {
                            $consulta = mysqli_query($conexion, 'SELECT idtemporada,idserie,sinopsis,orden FROM temporadas WHERE idtemporada=' . $_POST['idtemporada']);
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo '  <tr>
                                        <td>ID: </td>
                                        <td><input type="number" name="idtemporada" id="idtemporada" value="' . $row['idtemporada'] . '" readonly></td>
                                    </tr>';
                                echo '  <tr>
                                        <td>Sinopsis: </td>
                                        <td><textarea type="text" name="sinopsis" id="sinopsis">' . $row['sinopsis'] . '</textarea></td>
                                    </tr>';
                                echo '  <tr>
                                    <td>Orden: </td>
                                    <td><input type="text" name="orden" id="orden" value="' . $row['orden'] . '"></td>
                                </tr>';
                            }
                        }

                        ?>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
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