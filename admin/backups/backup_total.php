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

$backup_total = mysqli_query($conexion, 'CALL backup_total()');

if (!$backup_total) {
    die("Ha fallado la copia de seguridad. ERROR: ");
}
else {
    header("Location: ../welcome.php");
}