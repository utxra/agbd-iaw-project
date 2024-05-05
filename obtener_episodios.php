<?php
require 'login.php';

if(isset($_POST['idtemporada'])) {
    $conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
    
    if (!$conexion) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $idtemporada = mysqli_real_escape_string($conexion, $_POST['idtemporada']);
    
    $consulta = "SELECT nombre, sinopsis, imagen, idepisodio FROM episodios WHERE idtemporada = $idtemporada";

    $result = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="episodio row"> <div class="col-4 position-relative"><a href="./reproductor_series.php?episodio_id=' . $row['idepisodio'] . '"><i class="bi bi-play-circle-fill card-icon position-absolute top-50 start-50 translate-middle"></i></a><img src="data:image/jpg;base64,' . base64_encode($row['imagen']) . '"  class="w-100"></div><div class="col"><h3>'. $row['nombre'] .'</h3> <p>'. $row['sinopsis'] .'</p></div></div><hr>';
        }
    } else {
        echo "<p>No se encontraron episodios para esta temporada.</p>";
    }

    mysqli_close($conexion);
} else {
    echo "ID de temporada no proporcionado.";
}