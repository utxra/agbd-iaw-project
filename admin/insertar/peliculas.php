<?php
session_start();
require '../../login.php';

$conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

if (!$conexion) {
    echo "Ha sido imposible conectarse a la base de datos";
}

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
    <link rel="stylesheet" href="../../landing.css">
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
    <title>Página de administración - FJRA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/3b3dbab205.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container d-flex align-items-center vh-100">
        <form action="./insert.php?tabla=peliculas" method="post" enctype="multipart/form-data" class="w-100">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <table align="center">
                        
                        <tr>
                            <td style="color: #fff;">Título: </td>
                            <td>
                                <input class="form-control" name="titulo" id="titulo" style="width: 120%;" required>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="color: #fff;">Sinopsis: </td>
                            <td>
                                <textarea class="form-control" type="text" name="sinopsis" id="sinopsis" style="width: 120%;" required></textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="color: #fff;">Video (Link streaming): </td>
                            <td>
                                <input class="form-control" type="text" name="video" id="video" style="width: 120%;" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #fff;">Duración (min): </td>
                            <td>
                                <input class="form-control" type="number" name="duracion" id="duracion" style="width: 120%;" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #fff;">Director: </td>
                            <td>
                                <input class="form-control" type="text" name="director" id="director" style="width: 120%;" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #fff;">Año: </td>
                            <td>
                                <input class="form-control" type="number" name="año" id="año" style="width: 120%;" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #fff;">Imagen (Link): </td>
                            <td>
                                <input class="form-control" type="text" name="imagen" id="imagen" style="width: 120%;" required>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Insertar</button>
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