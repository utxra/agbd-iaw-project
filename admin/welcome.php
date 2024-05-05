<?php
session_start();

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
    <link rel="stylesheet" href="../landing.css">
    <title>Página de administración - FJRA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/3b3dbab205.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container-fluid">
        <div class="row selector-admin welcome">
            <div class="col">Bienvenido administrador/a</div>
        </div>
        <div class="row selector-admin welcome">
            <div class="col">
                <div style="text-align:center;padding:1em 0;">
                    <h4><a style="text-decoration:none;"><span
                                style="color:gray;">Hora actual en</span><br />Madrid, España</a></h4> <iframe
                        src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=small&timezone=Europe%2FMadrid"
                        width="100%" height="" frameborder="0" seamless></iframe>
                </div>
            </div>
        </div>
        <div class="row selector-admin welcome">
            <div class="col">¿Que desea realizar?</div>
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