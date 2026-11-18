<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["idUsuario"])) {
    header("location: login/login.php");
    exit();
}

?>