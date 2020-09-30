<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

// Enviar los datos al servidor limpios
$nombre=consultasSQL::clean_string($_POST['nombre-login']);
$clave=consultasSQL::clean_string(md5($_POST['clave-login'])); // Esta se envia en md5 al ser una clave

// Si los campos no estan vacios (Con el require ya no hace falta, se hace por seguridad)
if($nombre!="" && $clave!=""){

  // Busca USUARIO
    $consultaUser=ejecutarSQL::consultar("SELECT * FROM cliente WHERE Nombre='$nombre' AND Clave='$clave'"); // Conecta y consulta
    $filasUser=mysqli_num_rows($consultaUser); // mysqli_num_rows: Obtiene el número de filas del resultado de la consulta
    
    // SI encuentra USUARIO
    if($filasUser>0){
      $filaUnica=mysqli_fetch_array($consultaUser, MYSQLI_ASSOC); // mysqli_fetch_array: Obtiene un registro (una fila) del array
      $_SESSION['nombreUser']=$nombre;
      $_SESSION['claveUser']=$clave;
      $_SESSION['UserType']="User";
      $_SESSION['UserNIT']=$filaUnica['NIT'];
      echo '<script> location.href="index.php"; </script>';
    }
    // NO encuentra USUARIO
    else{
      // Busca ADMIN
        $consultaAdmin=ejecutarSQL::consultar("SELECT * FROM administrador WHERE Nombre='$nombre' AND Clave='$clave'");
        $filasAdmin=mysqli_num_rows($consultaAdmin);

        // SI encuentra ADMIN
        if($filasAdmin>0){
          $filaUnica=mysqli_fetch_array($consultaAdmin, MYSQLI_ASSOC);
          $_SESSION['nombreAdmin']=$nombre;
          $_SESSION['claveAdmin']=$clave;
          $_SESSION['UserType']="Admin";
          $_SESSION['adminID']=$filaUnica['id'];
          echo '<script> location.href="index.php"; </script>';
        }
        // NO encuentra ADMIN
        else{echo 'Error nombre o contraseña invalido';}
      }
    }

// Si los campos están vacios
else{echo 'Error campo vacío<br>Intente nuevamente';}
