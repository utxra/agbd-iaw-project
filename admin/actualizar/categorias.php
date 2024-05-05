<?php
session_start();
require '../../login.php';

$conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

if (!$conexion) {
    echo "Ha sido imposible conectarse a la base de datos";
}

if ($_SESSION['admin'] == 0) {
    header("Location: ./index.php");
}

$registros = mysqli_query($conexion, 'SELECT * FROM categorias')

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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form action="./update.php?tabla=categorias" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-12 text-center">
                            <table class="table table-dark table-hover">
                                <tbody>
                                    <select name="idcategoria" id="idcategoria" class="form-select">
                                        <option value="0">Seleccione</option>
                                        <?php
                                        $tablas = mysqli_query($conexion, 'SELECT idcategoria,nombre FROM categorias');
                                        while ($row = mysqli_fetch_assoc($tablas)) {
                                            echo '<option value="' . $row["idcategoria"] . '">' . $row["idcategoria"] . ' - ' . $row["nombre"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </tbody>

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