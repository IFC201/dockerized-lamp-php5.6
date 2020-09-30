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
    <section id="store" class="contenedor-flex">
      <!-- Capa 2 -->
      <div class="container">

        <!-- -- Fila 1: PRODUCTOS florart -- -->
        <div class="page-header">
          <h1>PRODUCTOS <small class="tittles-pages-logo">FLORART</small></h1>
        </div>

        <?php // Conecta a la BD y le hace una CONSULTA
        $checkAllCat=ejecutarSQL::consultar("SELECT * FROM categoria"); // Almacena la consulta
        $checkFilas=mysqli_num_rows($checkAllCat);  // Almacena el número de FILAS

        // Si hay categorías
        if($checkFilas>=1){ ?>
          
          <!-- -- Fila 2: SELECCIONE UNA CATEGORÍA & BUSCAR -- -->
          <div class="container-fluid">
            <div class="row">

              <!-- Columna 1: SELECCIONE UNA CATEGORÍA -->
              <div class="col-xs-12 col-md-4">
                <!-- Desplegable -->
                <div class="dropdown">
                  <!-- Botón -->
                  <button class="btn btn-primary btn-raised dropdown-toggle" type="button" id="drpdowncategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Seleccione una categoría &nbsp;
                    <span class="caret"></span> <!--Flecha para abajo-->
                  </button>
                  <!-- Lista desplegable -->
                  <ul class="dropdown-menu" aria-labelledby="drpdowncategory">
                    <?php // Mientras que el array tenga valores (Asociativo=Texto)
                    while($cate=mysqli_fetch_array($checkAllCat, MYSQLI_ASSOC)){
                      /* Cambia de URL e Imprime el nombre de la categoría (categ es una variable de dirección) */ echo '
                      <li><a href="product.php?categ='.$cate['CodigoCat'].'">'.$cate['Nombre'].'</a></li>
                      <li role="separator" class="divider"></li>'; // Línea separatoria
                    } ?>
                  </ul>
                </div>
              </div>
              
              <!-- Columna 2: BUSCAR -->
              <div class="col-xs-12 col-md-4 col-md-offset-4">
                <!-- Capa 1: Formulario -->
                <form action="./search.php" method="GET">
                  <!-- Capa 2: Exterior variable (is empty & is focused & has error) -->
                  <div class="form-group">
                    <!-- Capa 3: Interior fijo -->
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                      <input type="text" id="addon1" class="form-control" name="term" required="" title="Escriba nombre o marca del producto">
                      <span class="input-group-btn">
                        <button class="btn btn-info btn-raised" type="submit">Buscar</button>
                      </span>
                    </div>
                  </div>
                </form>
              </div>

            </div>
          </div>

          <?php // Limpia la variable de dirección "categ" y la almacena en $categoria (href="product.php?categ <--)
          $categoria=consultasSQL::clean_string($_GET['categ']); // Almacena el nombre de la categoría

          // Si la variable $categoría existe y tiene contenido
          if(isset($categoria) && $categoria!=""){  ?>
            
            <!-- -- Fila 3: Se muestran los productos de la categoría -- -->
            <div class="row">

              <?php // Sistema de páginas

              // Conectar BD
              $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
              mysqli_set_charset($mysqli, "utf8");

              // Operador ternario: si existe 'pag' (si estás en una página) entonces pásalo a un número y almacenalo, sino almacena 1
              $pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;                // Almacena el número de la página
              $regpagina = 6;                                                      // Almacena el máximo de productos en una página
              $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;  // Fórmula para contar dependiendo de la página

              // Cuenta y almacena el número de productos a mostrar desde $inicio (ej:60) hasta $regpagina (20+)
              $consultar_productos=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM producto WHERE CodigoCat='$categoria' AND Stock > 0 AND Estado='Activo' LIMIT $inicio, $regpagina");

              // Consulta las categorías que coincidan con la de la URL (Ej: "CodigoCat=cat1" = "categ=cat1")
              $selCat=ejecutarSQL::consultar("SELECT * FROM categoria WHERE CodigoCat='$categoria'");
              $datCat=mysqli_fetch_array($selCat, MYSQLI_ASSOC); // Almacena el ARRAY del primer registro encontrado

              // Consulta y almacena el array de todos los productos de la categoría
              $consultar_registros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
              $totalregistros = mysqli_fetch_array($consultar_registros, MYSQLI_ASSOC);
              
              // Cuenta y almacena el número de productos total de la categoría
              $contar_registros = array_values($totalregistros)[0]; // array_values devuelve todos los valores de un array

              // Cuenta y almacena el número de páginas (ceil aproxima al valor entero mayor)
              $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

              // Cuenta y almacena el número de productos de una página
              $productos_pagina = mysqli_num_rows($consultar_productos);

            // Si hay productos en la página
            if($productos_pagina>=1){
              echo '<h3 class="text-center">';
                echo 'Categoría:&nbsp<strong>'.$datCat['Nombre'].'</strong>&nbsp';
                echo '<span class="glyphicon glyphicon-eye-open"></span>&nbsp';
                echo 'Productos:&nbsp<strong>'.$productos_pagina.'</strong>&nbsp';
                echo 'de&nbsp<strong>'.$contar_registros.'</strong>';
              echo '</h3>';

                // Mientras el array tenga valores
                while($prod=mysqli_fetch_array($consultar_productos, MYSQLI_ASSOC)){  ?>

                  <!-- Capa 1: Columna -->
                  <div class="col-xs-12 col-sm-6 col-md-4">
                    <!-- Capa 2: Minuatura con bordes -->
                    <div class="thumbnail">

                      <!-- Contenedor Imágen -->
                      <div class="contenedor-img">
                        <!-- Imágen -->
                        <img class="ajustar-img" src="./assets/img-products/<?php if($prod['Imagen']!="" && is_file("./assets/img-products/".$prod['Imagen'])){ echo $prod['Imagen']; }else{ echo "default.png"; } ?> ">
                      </div>

                      <!-- Subtítulo -->
                      <div class="caption">
                        <h3>Marca: <?php echo $prod['Marca']; ?></h3>
                        <p>Nombre: <?php echo $prod['NombreProd']; ?></p>
                        <p>Precio: <?php echo $prod['Precio']; ?>€</p>
                        <!-- Enlace Detalles -->
                        <p class="text-center">
                          <a href="infoProd.php?CodigoProd=<?php echo $prod['CodigoProd']; ?>" class="btn btn-primary btn-raised btn-sm btn-block"><i class="fa fa-plus"></i>&nbsp; Detalles</a>
                        </p>
                      </div>

                   </div>
                 </div>     
                 <?php    
               } // FIN while


               if($numeropaginas>0):
                ?>
                <div class="clearfix"></div>
                <div class="text-center">
                  <ul class="pagination">
                    <?php if($pagina == 1): ?>
                      <li class="disabled">
                        <a>
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                    <?php else: ?>
                      <li>
                        <a href="product.php?categ=<?php echo $categoria; ?>&pag=<?php echo $pagina-1; ?>">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                    <?php endif; ?>


                    <?php
                    for($i=1; $i <= $numeropaginas; $i++ ){
                      if($pagina == $i){
                        echo '<li class="active"><a href="product.php?categ='.$categoria.'&pag='.$i.'">'.$i.'</a></li>';
                      }else{
                        echo '<li><a href="product.php?categ='.$categoria.'&pag='.$i.'">'.$i.'</a></li>';
                      }
                    }
                    ?>


                    <?php if($pagina == $numeropaginas): ?>
                      <li class="disabled">
                        <a>
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    <?php else: ?>
                      <li>
                        <a href="product.php?categ=<?php echo $categoria; ?>&pag=<?php echo $pagina+1; ?>">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    <?php endif; ?>
                  </ul>
                </div>
                <?php
              endif;
            }

            // Si no hay productos en la página
            else{echo '<h2 class="text-center">Lo sentimos, no hay productos registrados en la categoría <strong>"'.$datCat['Nombre'].'"</strong></h2>';} ?>
            
            
            
            </div>
            <?php
          }else{echo '<h2 class="text-center">Por favor seleccione una categoría para empezar</h2>';}





        // Si no hay categorías
        }else{echo '<h2 class="text-center">Lo sentimos, no hay productos ni categorías registradas en la tienda</h2>';} ?>
      
      </div>
    </section>

    <?php include './inc/footer.php'; ?>
  </body>

</html>