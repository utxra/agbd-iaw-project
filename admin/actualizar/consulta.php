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
        <div class="row w-100">
            <div class="col-12 text-center mb-3">
                <table class="table table-dark table-hover" align="center" style="color: #fff">
                    <?php
                    if ($_GET['tabla'] == "actores") {
                        $consulta = mysqli_query($conexion, 'UPDATE ' . $_GET['tabla'] . ' SET nombre = "' . $_POST['nombre'] . '" WHERE idactores=' . $_POST['idactor']);
                        if (!$consulta)
                            die("Ha fallado el borrado. ERROR: ");
                        $mostrar = mysqli_query($conexion, 'SELECT * FROM actores WHERE idactores=' . $_POST['idactor']);

                        while ($row = mysqli_fetch_assoc($mostrar)) {
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


                    if ($_GET['tabla'] == "categorias") {
                        $consulta = mysqli_query($conexion, 'UPDATE ' . $_GET['tabla'] . ' SET nombre = "' . $_POST['nombre'] . '" WHERE idcategoria=' . $_POST['idcategoria']);
                        if (!$consulta)
                            die("Ha fallado el borrado. ERROR: ");
                        $mostrar = mysqli_query($conexion, 'SELECT * FROM categorias WHERE idcategoria=' . $_POST['idcategoria']);

                        while ($row = mysqli_fetch_assoc($mostrar)) {
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

                    if ($_GET['tabla'] == "categorias_pelis") {
                        $consulta = mysqli_query($conexion, 'UPDATE ' . $_GET['tabla'] . ' SET idpelicula = "' . $_POST['idpelicula'] . '", idcategoria = "' . $_POST['idcategoria'] . '" WHERE id=' . $_POST['id']);
                        if (!$consulta)
                            die("Ha fallado el borrado. ERROR: ");
                        $mostrar = mysqli_query($conexion, 'SELECT * FROM categorias_pelis WHERE id=' . $_POST['id']);

                        while ($row = mysqli_fetch_assoc($mostrar)) {
                            echo '
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Película</th>
                                        <th>ID Categoría</th>
                                    </tr>
                                    <tr>
                                        <td>' . $row['id'] . '</td>
                                        <td>' . $row['idpelicula'] . '</td>
                                        <td>' . $row['idcategoria'] . '</td>
                                    </tr>';
                        }
                    }

                    if ($_GET['tabla'] == "categorias_series") {
                        $consulta = mysqli_query($conexion, 'UPDATE ' . $_GET['tabla'] . ' SET idserie = "' . $_POST['idserie'] . '", idcategoria = "' . $_POST['idcategoria'] . '" WHERE id=' . $_POST['id']);
                        if (!$consulta)
                            die("Ha fallado el borrado. ERROR: ");
                        $mostrar = mysqli_query($conexion, 'SELECT * FROM categorias_series WHERE id=' . $_POST['id']);

                        while ($row = mysqli_fetch_assoc($mostrar)) {
                            echo '
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Series</th>
                                        <th>ID Categoría</th>
                                    </tr>
                                    <tr>
                                        <td>' . $row['id'] . '</td>
                                        <td>' . $row['idserie'] . '</td>
                                        <td>' . $row['idcategoria'] . '</td>
                                    </tr>';
                        }
                    }

                    if ($_GET['tabla'] == "episodios") {
                        $consulta = mysqli_query($conexion, 'UPDATE ' . $_GET['tabla'] . ' SET idtemporada = "' . $_POST['idtemporada'] . '", sinopsis = "' . $_POST['sinopsis'] . '", video = "' . $_POST['video'] . '", duracion = "' . $_POST['duracion'] . '", orden = "' . $_POST['orden'] . '" WHERE idepisodio=' . $_POST['idepisodio']);
                        if (!$consulta)
                            die("Ha fallado la actualización. ERROR: ");
                        $mostrar = mysqli_query($conexion, 'SELECT * FROM episodios WHERE idepisodio =' . $_POST['idepisodio']);

                        while ($row = mysqli_fetch_assoc($mostrar)) {
                            echo '
                                <tr>
                                    <th>ID </th>
                                    <th>Título</th>
                                    <th>Sinopsis</th>
                                    <th>Duración</th>
                                    <th>Orden</th>
                                </tr>
                                <tr>
                                    <td>' . $row['idepisodio'] . '</td>
                                    <td>' . $row['nombre'] . '</td>
                                    <td>' . $row['sinopsis'] . '</td>
                                    <td>' . $row['duracion'] . '</td>
                                    <td>' . $row['orden'] . '</td>
                                </tr>';
                        }
                    }

                    if ($_GET['tabla'] == "peliculas") {
                        $consulta = mysqli_query($conexion, 'UPDATE ' . $_GET['tabla'] . ' SET titulo = "' . $_POST['titulo'] . '", sinopsis = "' . $_POST['sinopsis'] . '", video = "' . $_POST['video'] . '", duracion = "' . $_POST['duracion'] . '", año = "' . $_POST['año'] . '", director = "' . $_POST['director'] . '" WHERE idpelicula=' . $_POST['idpelicula']);
                        if (!$consulta)
                            die("Ha fallado la actualización. ERROR: ");
                        $mostrar = mysqli_query($conexion, 'SELECT * FROM peliculas WHERE idpelicula=' . $_POST['idpelicula']);

                        while ($row = mysqli_fetch_assoc($mostrar)) {
                            echo '
                                <tr>
                                    <th>ID Película</th>
                                    <th>Título</th>
                                    <th>Sinopsis</th>
                                    <th>Duración</th>
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

                    if ($_GET['tabla'] == "reparto_pelis") {
                        $consulta = mysqli_query($conexion, 'UPDATE ' . $_GET['tabla'] . ' SET idpelicula = "' . $_POST['idpelicula'] . '", idactor = "' . $_POST['idactor'] . '" WHERE idreparto=' . $_POST['idreparto']);
                        if (!$consulta)
                            die("Ha fallado la actualización. ERROR: ");
                        $mostrar = mysqli_query($conexion, 'SELECT * FROM reparto_pelis WHERE idreparto=' . $_POST['idreparto']);

                        while ($row = mysqli_fetch_assoc($mostrar)) {
                            echo '
                                <tr>
                                    <th>ID Reparto</th>
                                    <th>ID Película</th>
                                    <th>ID Actor</th>
                                </tr>
                                <tr>
                                    <td>' . $row['idreparto'] . '</td>
                                    <td>' . $row['idpelicula'] . '</td>
                                    <td>' . $row['idactor'] . '</td>
                                </tr>';
                        }
                    }

                    if ($_GET['tabla'] == "reparto_series") {
                        $consulta = mysqli_query($conexion, 'UPDATE ' . $_GET['tabla'] . ' SET idserie = "' . $_POST['idserie'] . '", idactor = "' . $_POST['idactor'] . '" WHERE idreparto=' . $_POST['idreparto']);
                        if (!$consulta)
                            die("Ha fallado la actualización. ERROR: ");
                        $mostrar = mysqli_query($conexion, 'SELECT * FROM reparto_series WHERE idreparto=' . $_POST['idreparto']);

                        while ($row = mysqli_fetch_assoc($mostrar)) {
                            echo '
                                <tr>
                                    <th>ID Reparto</th>
                                    <th>ID Serie</th>
                                    <th>ID Actor</th>
                                </tr>
                                <tr>
                                    <td>' . $row['idreparto'] . '</td>
                                    <td>' . $row['idserie'] . '</td>
                                    <td>' . $row['idactor'] . '</td>
                                </tr>';
                        }
                    }

                    if ($_GET['tabla'] == "series") {
                        $consulta = mysqli_query($conexion, 'UPDATE ' . $_GET['tabla'] . ' SET titulo = "' . $_POST['titulo'] . '", sinopsis = "' . $_POST['sinopsis'] .'", año_salida = "' . $_POST['año_salida'] .'", año_fin = "' . $_POST['año_fin'] . '", director = "' . $_POST['director'] .'", imagen = "' . $_POST['imagen'] .'" WHERE idserie=' . $_POST['idserie']);
                        if (!$consulta)
                            die("Ha fallado la actualización. ERROR: ");
                        $mostrar = mysqli_query($conexion, 'SELECT * FROM series WHERE idserie=' . $_POST['idserie']);

                        while ($row = mysqli_fetch_assoc($mostrar)) {
                            echo '
                                <tr>
                                    <th>ID</th>
                                    <th>Tírulo</th>
                                    <th>Sinopsis</th>
                                    <th>Año salida</th>
                                    <th>Año fin</th>
                                    <th>Director</th>
                                    <th>Imagen</th>
                                </tr>
                                <tr>
                                    <td>' . $row['idserie'] . '</td>
                                    <td>' . $row['titulo'] . '</td>
                                    <td>' . $row['sinopsis'] . '</td>
                                    <td>' . $row['año_salida'] . '</td>
                                    <td>' . $row['año_fin'] . '</td>
                                    <td>' . $row['director'] . '</td>
                                    <td>' . $row['imagen'] . '</td>
                                </tr>';
                        }
                    }

                    if ($_GET['tabla'] == "temporadas") {
                        $consulta = mysqli_query($conexion, 'UPDATE ' . $_GET['tabla'] . ' SET sinopsis = "' . $_POST['sinopsis'] . '", orden = "' . $_POST['orden'] . '" WHERE idtemporada=' . $_POST['idtemporada']);
                        if (!$consulta)
                            die("Ha fallado la actualización. ERROR: ");
                        $mostrar = mysqli_query($conexion, 'SELECT * FROM temporadas WHERE idtemporada=' . $_POST['idtemporada']);

                        while ($row = mysqli_fetch_assoc($mostrar)) {
                            echo '
                                <tr>
                                    <th>ID Temporada</th>
                                    <th>Sinopsis</th>
                                    <th>Orden</th>
                                </tr>
                                <tr>
                                    <td>' . $row['idtemporada'] . '</td>
                                    <td>' . $row['sinopsis'] . '</td>
                                    <td>' . $row['orden'] . '</td>
                                </tr>';
                        }
                    }
                    ?>
                </table>
            </div>
        </div>

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