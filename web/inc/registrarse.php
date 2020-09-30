<!-- Formulario REGISTRARTE -->
<form action="process/regclien.php" method="POST" role="form" data-form="save" class="FormEnviar">
  <div class="container-fluid"> <!--Campos fluidos-->
    <div class="row"> <!--Fila de campos-->
      
      <!-- -- DNI -- form-group & label-floating: caja de formulario -->
      <div class="col-xs-12">
        <div class="form-group label-floating">
          <label class="control-label"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp; Ingrese su número de DNI</label>
          <input class="form-control" type="text" required name="clien-nit" pattern="[0-9]{1,15}" title="Ingrese su número de DNI. Solamente números" maxlength="15" >
        </div>
      </div>

      <!-- -- NOMBRE -- -->
      <div class="col-xs-12 col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label"><i class="fa fa-user"></i>&nbsp; Ingrese su nombre</label>
          <input class="form-control" type="text" required name="clien-fullname" title="Ingrese sus nombre (solamente letras)" pattern="[a-zA-Z ]{1,50}" maxlength="50">
        </div>
      </div>
      
      <!-- -- APELLIDOS -- -->
      <div class="col-xs-12 col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label"><i class="fa fa-user"></i>&nbsp; Ingrese su apellido</label>
          <input class="form-control" type="text" required name="clien-lastname" title="Ingrese su apellido (solamente letras)" pattern="[a-zA-Z ]{1,50}" maxlength="50">
        </div>
      </div>
      
      <!-- -- TELÉFONO -- -->
      <div class="col-xs-12 col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label"><i class="fa fa-mobile"></i>&nbsp; Ingrese su número telefónico</label>
          <input class="form-control" type="tel" required name="clien-phone" maxlength="15" title="Ingrese su número telefónico. Mínimo 8 digitos máximo 15">
        </div>
      </div>

      <!-- -- EMAIL -- -->
      <div class="col-xs-12 col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp; Ingrese su Email</label>
          <input class="form-control" type="email" required name="clien-email" title="Ingrese su dirección de Email" maxlength="50">
        </div>
      </div>

      <!-- -- DIRECCIÓN -- -->
      <div class="col-xs-12">
        <div class="form-group label-floating">
          <label class="control-label"><i class="fa fa-home"></i>&nbsp; Ingrese su dirección</label>
          <input class="form-control" type="text" required name="clien-dir" title="Ingrese la direción en la que reside actualmente" maxlength="100">
        </div>
      </div>
      
      <!-- -- USUARIO -- -->
      <div class="col-xs-12">
        <div class="form-group label-floating">
          <label class="control-label"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp; Ingrese su nombre de usuario</label>
          <input class="form-control" type="text" required name="clien-name" title="Ingrese su nombre. Máximo 9 caracteres (solamente letras y numeros sin espacios)" pattern="[a-zA-Z0-9]{1,9}" maxlength="9">
        </div>
      </div>
      <!-- -- CONTRASEÑA 1 -- -->
      <div class="col-xs-12 col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label"><i class="fa fa-lock"></i>&nbsp; Introduzca una contraseña</label>
          <input class="form-control" type="password" required name="clien-pass" title="Defina una contraseña para iniciar sesión">
        </div>
      </div>
      
      <!-- -- CONTRASEÑA 2 -- -->
      <div class="col-xs-12 col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label"><i class="fa fa-lock"></i>&nbsp; Repita la contraseña</label>
          <input class="form-control" type="password" required name="clien-pass2" title="Repita la contraseña">
        </div>
      </div>

    </div>
  </div><!-- REGISTRARSE -->
  <p><button type="submit" class="btn btn-primary btn-block btn-raised">Registrarse</button></p>
</form>