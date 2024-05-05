<?php
require 'login.php';

$conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

if (!$conexion) {
    echo "Ha sido imposible conectarse a la base de datos";
}

if (isset($_GET['episodio_id'])) {
    $episodio_id = $_GET['episodio_id'];
    $consulta = "SELECT video,nombre FROM episodios WHERE idepisodio = $episodio_id";
    $resultado = mysqli_query($conexion, $consulta);
    while ($row = mysqli_fetch_array($resultado)) {
        $video = $row['video'];
        $titulo = $row['nombre'];
    }
} 
else {
    header("Location: ./index.php");
    exit;
}

$cookie_id = "restauracion_episodio_".$episodio_id;

if (isset($_COOKIE[$cookie_id])) {
    $tiempoRestauracion = $_COOKIE[$cookie_id];
} else {
    $tiempoRestauracion = 0;
}

?>

<html>

<head>
    <title>Reproductor de vídeo</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="./media/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
    <script src="https://kit.fontawesome.com/3b3dbab205.js" crossorigin="anonymous"></script>
    <style>
        body {
            /* background-color: black; */
            font-family: sans-serif;
            overflow-y: hidden;
        }

        .contenedor {
            margin: none;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .nav-netflix-control {
            position: absolute;
            top: 0;
            left: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0));
            color: white;
            padding: 10px;
            text-align: left;
            display: none;
            transition: 0.3s;
            font-size: 300%;
            width: 100%;
        }

        .contenedor:hover .nav-netflix-control {
            display: block;
        }

        video {
            max-width: 100%;
            height: auto;
        }

        a:link,
        a:visited {
            color: unset;
            text-decoration: unset;
        }

        a:link:active,
        a:visited:active {
            color: (internal value);
        }

        :root {
            --plyr-color-main: red;
        }

    </style>
</head>

<body>
    <div class="contenedor">
        <video id="player" height="100%" width="100%" controls autoplay>
            <source src='<?php echo $video ?>' type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>
        <div class="nav-netflix-control">
            <a href="./index.php"><i class="fa-solid fa-arrow-left"></i></a>
            <?php echo " " . $titulo ?>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const player = new Plyr('#player');

            player.on('loadedmetadata', () => {
                // Verificar si hay un tiempo de restauración guardado en la cookie
                const tiempoRestauracion = <?php echo json_encode($tiempoRestauracion); ?>;
                if (tiempoRestauracion) {
                    // Saltar al tiempo de restauración guardado
                    player.currentTime = parseFloat(tiempoRestauracion);
                }
            });
        });
    </script>

    <script>
        window.addEventListener("beforeunload", function (event) {
            var player = document.getElementById("player");
            if (player && !player.paused) {
                var currentTime = player.currentTime;
                document.cookie = "<?php echo $cookie_id ?>" + "=" + encodeURIComponent(currentTime) + "; path=/";
            }
        });
    </script>

</body>

</html>

<?php
    mysqli_close($conexion);
?>
