<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Carrito de compras</title>
    <?php 
    include './inc/link.php'; 
    require_once "library/configServer.php";
    require_once "library/consulSQL.php";
    ?>
  </head>

  <body id="container-page-index">
    <?php include './inc/navbar.php'; ?>

    <!-- Capa 1: Exterior -->
    <section id="container-pedido" class="contenedor-flex">
      <!-- Capa 2: Interior -->
      <div class="container">

        <!-- Cabecera -->
        <div class="page-header">
          <h1>CARRITO DE COMPRAS <small class="tittles-pages-logo">FLORART</small></h1>
        </div>
        
        <!-- Fila -->
        <div class="row">
          <!-- Columna única -->
          <div class="col-xs-12">

            <?php  // Si existe 'carro'
            if(!empty($_SESSION['carro'])){

              // Variables para calcular la tabla
              $subtotal = 0;
              $cantidad = 0;
              ?>
              
              <!-- Bloque 1: Tabla -->
              <!-- Capa 1 -->
              <div class="table-responsive">
                <!-- Capa 2 -->
                <table class="table table-bordered table-hover">

                  <!-- Fila 1: Tabla -> Cabecera -->
                  <thead>
                    <tr class="bg-success">
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Cantidad</th>
                      <th>Subtotal</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
              
                  <!-- Para explicar la tabla
                    echo $arrayProd;
                    echo ' -> ' ;
                    echo array_values($arrayProd)[0];
                    echo '<br>'; -->

                  <!-- Fila 2: Tabla -> Productos --> <?php
                  foreach($_SESSION['carro'] as $arrayProd){ /* $arrayProd almacena el array de la sesión 'carro'
                                                                para consultar cuales de ellos están en el carro */

                    // Consulta a la BD: ¿Cuáles de ellos están añadidos al carro?
                    $consulta=ejecutarSQL::consultar("SELECT * FROM producto WHERE CodigoProd='".$arrayProd['producto']."'");

                    // $fila: Almacena los que están añadidos al carro
                    while($fila = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) { // Bucle de los productos

                      /* Fila de cada producto */ echo "
                      <tbody>
                        <tr>
                          <td> ".$fila['NombreProd']."</td>
                          <td> ".$fila['Precio']."</td>
                          <td> ".$arrayProd['cantidad']."</td>
                          <td> ".$fila['Precio']*$arrayProd['cantidad']."</td>
                          <td>
                            <form action='process/quitarproducto.php' method='POST' class='FormEnviar' data-form=''>
                              <input type='hidden' value='".$arrayProd['producto']."' name='codigo'>
                              <button class='btn btn-danger btn-raised btn-xs'>Eliminar</button>
                            </form>
                          </td>
                        </tr>
                      </tbody>";

                      // Formulas para calcular la tabla
                      $cantidad += $arrayProd['cantidad'];
                      $subtotal += $fila['Precio']*$arrayProd['cantidad'];
                      $total = $subtotal*1.21;
                    }

                    mysqli_free_result($consulta);
                  } ?>
                  
                  <!-- Fila 3: Tabla -> Total --> <?php echo '
                  <tr class="bg-info">
                    <td colspan="2">Total</td>
                    <td><strong>'.$cantidad.'</strong></td>
                    <td><strong>' .number_format($subtotal,2, ',', ' ').' €</strong></td>
                  </tr>'; ?>

                  <!-- Fila 4: Tabla -> Total + IVA --> <?php echo '
                  <tr class="bg-danger">
                    <td colspan="3" class="text-right">Total +IVA (21%)</td>
                    <td><strong>' .number_format($total,2, ',', ' ').' €</strong></td>
                  </tr>'; ?>
                </table><div class="ResForm"></div>
              </div>

              <!-- Bloque 2: Enlaces -->
              <p class="text-center">
                <a href="product.php" class="btn btn-primary btn-raised btn-lg">Seguir comprando</a>
                <a href="#!" class="vaciar-carrito btn btn-danger btn-raised btn-lg">Vaciar el carrito</a>
                <a href="pedido.php" class="btn btn-success btn-raised btn-lg">Confirmar el pedido</a>
              </p>  <?php

            }else{  // No existe 'carro'
              echo '<p class="text-center text-danger lead">El carrito de compras esta vacío</p><br>
              <a href="product.php" class="btn btn-primary btn-lg btn-raised">Ir a Productos</a>';
            } ?>

          </div>
        </div>

      </div>
    </section>

    <?php include './inc/footer.php'; ?>
  </body>
</html>