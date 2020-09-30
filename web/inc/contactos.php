<!-- Contenedor con el borde rayado -->               
<div id="container-form">

  <!-- -- Contenedor de los TABS -- -->
  <ul class="contenedor-tabs">
    <li class="tab tab-segunda active"><a href="#contacto-es"><img src="./assets/icons/espana.png" height="35" width="35"> SOBRE FLORART</a></li>
    <li class="tab tab-primera"><a href="#contacto-en"><img src="./assets/icons/reino-unido.png" height="35" width="35"> ABOUT FLORART</a></li>          
  </ul>

  <!-- -- Contendor AMBOS formularios -- (Oculto=display:none & Visible=display:block) -->
  <div class="contenido-tab">

    <!-- Contenedor INICIAR SESION -->
    <div id="contacto-es">
      <?php include './inc/contacto-es.php'; ?><!--Formulario INICIAR SESIÓN-->
    </div>

    <!-- Contenedor REGISTRARSE -->
    <div id="contacto-en">
      <?php include './inc/contacto-en.php'; ?><!--Formulario REGISTRARSE-->
    </div>

  </div>

</div>