<?php
    error_reporting(E_PARSE);
    session_start();
	include '../library/configServer.php';
	include '../library/consulSQL.php';
    $codigo=consultasSQL::clean_string($_POST['codigo']);
    unset($_SESSION['carro'][$codigo]); // La variable $codigo se pone para no borrar todos los productos del carrito
    echo '<script> window.location="carrito.php"; </script>';