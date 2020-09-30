<?php
  include './library/configServer.php';
  include './library/consulSQL.php';
?>
<!DOCTYPE html>
<html lang="es">

  <head>
    <title>Pedido</title>
    <?php include './inc/link.php'; ?>
  </head>
  
  <body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
    
    <!-- Contenedor exterior -->
    <section id="container-pedido" class="contenedor-flex">

      <!-- Contenedor interior 1/3 -->
      <div class="container">

        <!-- Cabecera -->
        <div class="page-header">
          <h1>PEDIDOS <small class="tittles-pages-logo">FLORART</small></h1>
        </div>

        <!-- Cuerpo (Fila) -->
        <div class="row">
          <!-- Cuerpo (Columna) -->
          <div class="col-xs-12 col-sm-8 col-sm-offset-2">

            <!-- Si la sesión está abierta --><?php
            if($_SESSION['UserType']=="Admin" || $_SESSION['UserType']=="User"){
              // Si la sesión 'carro' existe
              if(isset($_SESSION['carro'])){
                ?>

                <div class="container-fluid">
                  <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                      <p class="text-center lead">Selecciona un metodo de pago</p>
                      <img class="img-responsive center-all-contens" src="assets/img/credit-card.png" height="42" width="42">
                      <p class="text-center">
                        <button class="btn btn-lg btn-raised btn-success btn-block" data-toggle="modal" data-target="#PagoModalTran">Pago amistoso</button>
                      </p>
                    </div>
                  </div>
                </div>
              <?php
              }// Si la sesión 'carro' no existe
              else{echo '<p class="text-center lead">No tienes pedidos pendientes de pago</p>';}
            }// Si la sesión está cerrada
            else{echo '<p class="text-center lead">Inicia sesión para realizar pedidos</p>';}
            ?>

          </div>
        </div>
      </div>
      
      <!-- Si tiene pedidos realizados --> <?php 
      if($_SESSION['UserType']=="User"){ // Consulta todos los pedidos del usuario actual
        $consultaC=ejecutarSQL::consultar("SELECT * FROM venta WHERE NIT='".$_SESSION['UserNIT']."'");
        ?>
        
        <!-- Contenedor interior 2/3 -->
        <div class="container">
          <div class="page-header">
            <h1>Pedidos realizados</h1>
          </div>
        </div>

        <!-- Si hay algún pedido --> <?php 
        if(mysqli_num_rows($consultaC)>=1){ ?> 
          
          <!-- Contenedor interior 3/3 -->
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <table class="table table-hover table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Descuento</th>
                      <th>Total</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($rw=mysqli_fetch_array($consultaC, MYSQLI_ASSOC)){
                      ?> 
                      <tr>
                        <td><?php echo $rw['Fecha']; ?></td>
                        <td><?php echo $rw['Descuento']; ?>%</td>
                        <td>$<?php echo $rw['TotalPagar']; ?></td>
                        <td>
                          <?php
                          switch ($rw['Estado']) {
                            case 'Enviado':
                            echo "En camino";
                            break;
                            case 'Pendiente':
                            echo "En espera";
                            break;
                            case 'Entregado':
                            echo "Entregado";
                            break;
                            default:
                            echo "Sin informacion";
                            break;
                          }
                          ?>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <?php
        }

        else{echo '<p class="text-center lead">No tienes ningun pedido realizado</p>';}
        mysqli_free_result($consultaC);
      }

        ?>
    </section>
    
    <!-- Modal Pago por transacción bancaria -->
    <div class="modal fade" id="PagoModalTran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        
        <!-- Formulario para pagar -->
        <form class="modal-content FormEnviar" action="process/confirmcompra.php" method="POST" role="form" data-form="save">
          
          <!-- Parte 1 -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Pago amistoso</h4>
          </div>
          
          <!-- Parte 2 -->
          <div class="modal-body">
            <?php
            $consult1=ejecutarSQL::consultar("SELECT * FROM cuentabanco");
            if(mysqli_num_rows($consult1)>=1){
              $datBank=mysqli_fetch_array($consult1, MYSQLI_ASSOC);
              ?>

              <!-- Si es Administrador -->
              <?php if($_SESSION['UserType']=="Admin"): ?>
                
                <!-- DNI del cliente que comprará este producto -->
                <div class="form-group label-floating">
                  <label class="control-label"><i class="fa fa-user"></i>&nbsp; DNI del cliente que comprará este producto</label>
                  <input class="form-control" type="text" required required name="Cedclien" title="Ingrese el DNI del cliente que comprará este producto" maxlength="50">
                </div></br>
                <!-- Mensaje -->
                <textarea class="estilotextarea" name="NumDepo" placeholder="Escribe aquí un mensaje para el administrador (Opcional)" maxlength="250"></textarea>

                <!-- Imagen -->
                <div class="form-group">
                  <input type="file" name="comprobante">
                  <div class="input-group">
                    <input type="text" readonly="" class="form-control" placeholder="Seleccione una imagen a enviar (Opcional)">
                    <span class="input-group-btn input-group-sm">
                      <button type="button" class="btn btn-fab btn-fab-mini">
                        <i class="fa fa-file-image-o" aria-hidden="true"></i>
                      </button>
                    </span>
                  </div>
                  <p class="help-block"><small>Tipos de archivos admitidos, imagenes .jpg y .png. Maximo 5 MB</small></p>
                </div>

              <!-- Si es Usuario -->
              <?php else: ?>
                <!-- Mensaje -->
                <textarea class="estilotextarea" name="NumDepo" placeholder="Escribe aquí un mensaje para el administrador (Opcional)" maxlength="250"></textarea>

                <input type="hidden" name="Cedclien" value="<?php echo $_SESSION['UserNIT']; ?>">
                <div class="form-group">
                  <input type="file" name="comprobante">
                  <div class="input-group">
                    <input type="text" readonly="" class="form-control" placeholder="Seleccione una imagen a enviar (Opcional)">
                    <span class="input-group-btn input-group-sm">
                      <button type="button" class="btn btn-fab btn-fab-mini">
                        <i class="fa fa-file-image-o" aria-hidden="true"></i>
                      </button>
                    </span>
                  </div>
                  <p class="help-block"><small>Tipos de archivos admitidos, imagenes .jpg y .png. Maximo 5 MB</small></p>
                </div>
                <?php 
              endif;
            }else{
              echo "Ocurrio un error: Parese ser que no se ha configurado las cuentas de banco";
            }
            mysqli_free_result($consult1);
            ?>
          </div>
          
          <!-- Parte 3 -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm btn-raised" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary btn-sm btn-raised">Confirmar</button>
          </div>

        </form>

      </div>
    </div>

    <div class="ResForm"></div>
    <?php include './inc/footer.php'; ?>

  </body>
</html>
