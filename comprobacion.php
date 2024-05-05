<?php 

session_start();


if ($_POST['usuario']=='admin' && $_POST['passwd']=='admin') {
    $_SESSION['admin'] = 1;
    header("Location: ./administracion.php");
}
else {
    header("Location: ./login_page.php?error=1");
}