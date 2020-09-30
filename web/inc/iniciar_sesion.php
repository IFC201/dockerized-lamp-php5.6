<!-- Formulario INICIAR SESIÓN -->
<form action="process/login.php" method="post" role="form" data-form="login" class="FormEnviar">

  <!-- --   NOMBRE   -- form-group & label-floating: caja de formulario -->
  <div class="form-group label-floating">
    <!-- control-label: movimiento de etiqueta & glyphicon: iconos modal (usuario y clave) -->
    <label class="control-label"><span class="glyphicon glyphicon-user"></span>&nbsp;Nombre</label>
    <!-- form-control: input interactivo (arriba y pequeño) requerido y color negro -->
    <input type="text" class="form-control" name="nombre-login" required="">
  </div>
  
  <!-- -- CONTRASEÑA -- -->
  <div class="form-group label-floating">
    <label class="control-label"><span class="glyphicon glyphicon-lock"></span>&nbsp;Contraseña</label>
    <input type="password" class="form-control" name="clave-login" required="">
  </div>
  
  <!-- -- INICIAR SESIÓN -- CANCELAR -- modal-footer: Los alinea a la derecha -->
  <div class="modal-footer">
    <!-- btn's formato de botones (bootstrap) -->
    <button type="submit" class="btn btn-primary btn-raised btn-sm">Iniciar sesión</button>
    <button type="button" class="btn btn-danger btn-raised btn-sm" data-dismiss="modal">Cancelar</button>
  </div>

  <!-- Iniciando sesión & Errores -->
  <div class="ResFormL"></div>
</form>