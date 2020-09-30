<!-- Contenedor con el borde rayado -->               
<div id="container-form">

  <!-- -- Contenedor de los TABS -- -->
  <ul class="contenedor-tabs">
    <li class="tab tab-segunda active"><a href="#iniciar-sesion">Iniciar Sesión</a></li>
    <li class="tab tab-primera"><a href="#registrarse">Registrarse</a></li>          
  </ul>

  <!-- -- Contendor AMBOS formularios -- (Oculto=display:none & Visible=display:block) -->
  <div class="contenido-tab">

    <!-- Contenedor INICIAR SESION -->
    <div id="iniciar-sesion">
      <p class="text-center text-primary"><!-- Párrafo para centrar el icono de sesión --> 
        <br><br>
        <i class="fa fa-user-circle-o fa-3x" aria-hidden="true"></i><!-- Icono para iniciar sesión -->
      </p>
      <?php include './inc/iniciar_sesion.php'; ?><!--Formulario INICIAR SESIÓN-->
    </div>

    <!-- Contenedor REGISTRARSE -->
    <div id="registrarse">
      <?php include './inc/registrarse.php'; ?><!--Formulario REGISTRARSE-->
    </div>

  </div>

</div>