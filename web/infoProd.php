<?php
include './library/configServer.php';
include './library/consulSQL.php';
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Productos</title>
    <?php include './inc/link.php'; ?>
  </head>

  <body id="container-page-product">
    <?php include './inc/navbar.php'; ?>

    <!-- Capa 1 -->
    <section id="infoproduct" class="contenedor-flex">
      <!-- Capa 2 -->
      <div class="container">
        <!-- Capa 3 -->
        <div class="row">
          
          <!-- Cabecera -->
          <div class="page-header">
            <h1>DETALLE DE PRODUCTO <small class="tittles-pages-logo">FLORART</small></h1>
          </div>
          
          <?php 
          $CodigoProducto=consultasSQL::clean_string($_GET['CodigoProd']);
          $productoinfo=  ejecutarSQL::consultar("SELECT producto.CodigoProd,producto.NombreProd,producto.CodigoCat,categoria.Nombre,producto.Precio,producto.Stock,producto.Imagen FROM categoria INNER JOIN producto ON producto.CodigoCat=categoria.CodigoCat  WHERE CodigoProd='".$CodigoProducto."'");
          while($fila=mysqli_fetch_array($productoinfo, MYSQLI_ASSOC)){

            /* Columna 1/2 */  echo '
            <div class="col-xs-12 col-sm-6">
              <h3 class="text-center">Información de producto</h3>
              <br><br>
              <h4><strong>Nombre: </strong>'.$fila['NombreProd'].'</h4><br>
              <h4><strong>Precio: </strong>'.$fila['Precio'].' €'.'</h4><br>
              <h4><strong>Cantidad: </strong>'.$fila['Stock'].'</h4><br>
              <h4><strong>Categoria: </strong>'.$fila['Nombre'].'</h4>';

              // Si hay algúno en stock
              if($fila['Stock']>=1){
                // Si ha iniciado sesión
                if($_SESSION['nombreAdmin']!="" || $_SESSION['nombreUser']!=""){

                  /* Formulario -> Se envía por POST a process/carrito.php */  echo '
                  <form action="process/carrito.php" method="POST" class="FormEnviar" data-form="">
                    <input type="hidden" value="'.$fila['CodigoProd'].'" name="codigo">
                    <label class="text-center"><small>Agrega la cantidad de productos que añadiras al carrito de compras (Maximo '.$fila['Stock'].' productos)</small></label>
                    <div class="form-group">
                      <input type="number" class="form-control" value="1" min="1" max="'.$fila['Stock'].'" name="cantidad">
                    </div>
                    <button class="btn btn-lg btn-raised btn-success btn-block"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; Añadir al carrito</button>
                  </form>
                  <div class="ResForm"></div>';

                }else{
                  echo '<p class="text-center"><small>Para agregar productos al carrito de compras debes iniciar sesion</small></p><br>';
                  echo '<button class="btn btn-lg btn-raised btn-info btn-block" data-toggle="modal" data-target=".modal-login"><i class="fa fa-user"></i>&nbsp;&nbsp; Iniciar sesion</button>';
                }
              }else{
                echo '<p class="text-center text-danger lead">No hay existencias de este producto</p><br>';
              }
              if($fila['Imagen']!="" && is_file("./assets/img-products/".$fila['Imagen'])){ 
                $imagenFile="./assets/img-products/".$fila['Imagen']; 
              }else{ 
                $imagenFile="./assets/img-products/default.png"; 
              }
              echo '<br>
              <a href="product.php" class="btn btn-lg btn-primary btn-raised btn-block"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;Regresar a la tienda</a>
            </div>';

            /* Columna 2/2 */ echo '
            <div class="col-xs-12 col-sm-6">
            <br><br><br>
            <img class="img-responsive" src="'.$imagenFile.'">
            </div>';
          }
          ?>

        </div>
      </div>
    </section>

    <?php include './inc/footer.php'; ?>
  </body>
</html>