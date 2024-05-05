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
                            foreach ($_POST["idactores"] as $codborrado) {
                                $delete = mysqli_query($conexion, "DELETE FROM " . $_GET['tabla'] . " WHERE idactores='$codborrado'");
                                if (!$delete)
                                    die("Ha fallado el borrado. ERROR: ");
                            }
                            header("Location: ../welcome.php");
                        }

                        if ($_GET['tabla'] == "categorias") {
                            foreach ($_POST["idcategorias"] as $codborrado) {
                                $delete = mysqli_query($conexion, "DELETE FROM " . $_GET['tabla'] . " WHERE idcategoria='$codborrado'");
                                if (!$delete)
                                    die("Ha fallado el borrado. ERROR: ");
                            }
                            header("Location: ../welcome.php");
                        }

                        if ($_GET['tabla'] == "categorias_pelis") {
                            foreach ($_POST["id"] as $codborrado) {
                                $delete = mysqli_query($conexion, "DELETE FROM " . $_GET['tabla'] . " WHERE id='$codborrado'");
                                if (!$delete)
                                    die("Ha fallado el borrado. ERROR: ");
                            }
                            header("Location: ../welcome.php");
                        }

                        if ($_GET['tabla'] == "categorias_series") {
                            foreach ($_POST["id"] as $codborrado) {
                                $delete = mysqli_query($conexion, "DELETE FROM " . $_GET['tabla'] . " WHERE id='$codborrado'");
                                if (!$delete)
                                    die("Ha fallado el borrado. ERROR: ");
                            }
                            header("Location: ../welcome.php");
                        }

                        if ($_GET['tabla'] == "episodios") {
                            foreach ($_POST["idepisodios"] as $codborrado) {
                                $delete = mysqli_query($conexion, "DELETE FROM " . $_GET['tabla'] . " WHERE idepisodio='$codborrado'");
                                if (!$delete)
                                    die("Ha fallado el borrado. ERROR: ");
                            }
                            header("Location: ../welcome.php");
                        }
                        
                        if ($_GET['tabla'] == "peliculas") {
                            foreach ($_POST["idpeliculas"] as $codborrado) {
                                $delete = mysqli_query($conexion, "DELETE FROM " . $_GET['tabla'] . " WHERE idpelicula='$codborrado'");
                                if (!$delete)
                                    die("Ha fallado el borrado. ERROR: ");
                            }
                            header("Location: ../welcome.php");
                        }

                        if ($_GET['tabla'] == "reparto_pelis") {
                            foreach ($_POST["idreparto"] as $codborrado) {
                                $delete = mysqli_query($conexion, "DELETE FROM " . $_GET['tabla'] . " WHERE idreparto='$codborrado'");
                                if (!$delete)
                                    die("Ha fallado el borrado. ERROR: ");
                            }
                            header("Location: ../welcome.php");
                        }

                        if ($_GET['tabla'] == "reparto_series") {
                            foreach ($_POST["idreparto"] as $codborrado) {
                                $delete = mysqli_query($conexion, "DELETE FROM " . $_GET['tabla'] . " WHERE idreparto='$codborrado'");
                                if (!$delete)
                                    die("Ha fallado el borrado. ERROR: ");
                            }
                            header("Location: ../welcome.php");
                        }

                        if ($_GET['tabla'] == "series") {
                            foreach ($_POST["idseries"] as $codborrado) {
                                $delete = mysqli_query($conexion, "DELETE FROM " . $_GET['tabla'] . " WHERE idserie='$codborrado'");
                                if (!$delete)
                                    die("Ha fallado el borrado. ERROR: ");
                            }
                            header("Location: ../welcome.php");
                        }

                        if ($_GET['tabla'] == "temporadas") {
                            foreach ($_POST["idtemporadas"] as $codborrado) {
                                $delete = mysqli_query($conexion, "DELETE FROM " . $_GET['tabla'] . " WHERE idtemporada='$codborrado'");
                                if (!$delete)
                                    die("Ha fallado el borrado. ERROR: ");
                            }
                            header("Location: ../welcome.php");
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