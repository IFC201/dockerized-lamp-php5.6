<?php 
session_start(); 
error_reporting(E_PARSE);
?>

<!-- Navbar variable y oculto (main.js) -->
<nav id="navbar-auto-ocultar">

  <!-- Vista ordenador (Fila oculta en -786px) -->
  <div class="row hidden-xs">
  
    <!-- 4 columnas -->
    <div class="col-xs-4">
      <!-- Título -->
      <p class="text-navbar tittles-pages-logo">FLORART</p>
    </div>
    
    <!-- 8 columnas -->
    <div class="col-xs-8">
      <!-- Contenedor del menú 1 -->
      <div class="contenedor-tabla pull-right">
        <!-- Contenedor del menú 2 -->
        <div class="contenedor-tr">
          
          <!-- Enlaces por defecto -->
          <a href="index.php" class="table-cell-td">Inicio</a>
          <a href="product.php" class="table-cell-td">Productos</a>

          <!-- Enlaces de administrador -->
          <?php
            if(!$_SESSION['nombreAdmin']==""){
              echo ' 
              <a href="carrito.php" class="table-cell-td">Carrito</a>
              <a href="configAdmin.php" class="table-cell-td">Administración</a>
              <a href="#!" class="table-cell-td exit-system">
              <i class="fa fa-user"></i>&nbsp;&nbsp;'.$_SESSION['nombreAdmin'].'
              </a>
              ';

            }else if(!$_SESSION['nombreUser']==""){
              echo ' 
              <a href="pedido.php" class="table-cell-td">Pedido</a>
              <a href="carrito.php" class="table-cell-td">Carrito</a>
              <a href="#!" class="table-cell-td exit-system">
              <i class="fa fa-user"></i>&nbsp;&nbsp;'.$_SESSION['nombreUser'].'
              </a>
              ';

            }else{
              echo ' 
              <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-contacto"><span class="glyphicon glyphicon-info-sign"></span></a>
              <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-login">
              <i class="fa fa-user"></i>&nbsp;&nbsp;Login
              </a>
              ';
            }
          ?>

        </div>
      </div>
    </div>
  </div>
  
  <!-- Vista móvil (Fila visible en -786px) -->
  <div class="row visible-xs">

    <!-- 12 columnas -->
    <div class="col-xs-12">

      <!-- Menú -->
      <button class="btn btn-default pull-left button-mobile-menu" id="btn-mobile-menu">
        <i class="fa fa-th-list"></i>&nbsp;&nbsp;Menú 
      </button>
      
      <!-- Iniciar Sesión -->
      <?php
        if(!$_SESSION['nombreAdmin']==""){echo '
          <a href="#"  id="button-login-xs" class="elements-nav-xs exit-system">
          <i class="fa fa-user"></i>&nbsp; '.$_SESSION['nombreAdmin'].' 
          </a>';
        }else if(!$_SESSION['nombreUser']==""){
          echo '
          <a href="#"  id="button-login-xs" class="elements-nav-xs exit-system">
          <i class="fa fa-user"></i>&nbsp; '.$_SESSION['nombreUser'].' 
          </a>';
        }else{
          echo '
          <a href="#" data-toggle="modal" data-target=".modal-login" id="button-login-xs" class="elements-nav-xs">
          <i class="fa fa-user"></i>&nbsp; Iniciar Sesión
          </a> 
          ';
        }
      ?>

    </div>
  </div>
</nav>

<!-- Modal login (Ventana login) Tutorial: http://blog.gtoeurope.es/crear-modal-en-bootstrap -->
<?php include './inc/modal_login.php'; ?>
<?php include './inc/modal_contacto.php'; ?>

<!-- --   MENÚ  -- Los hidden ocultan el menú en los media query-->
<div id="mobile-menu-list" class="hidden-sm hidden-md hidden-lg">

  <!-- Título del menu -->
  <h3 class="text-center tittles-pages-logo">FLORART</h3>
  
  <!-- Botón de cerrar -->
  <button class="btn btn-default button-mobile-menu" id="button-close-mobile-menu">
    <!-- Icono de cerrar -->
    <i class="fa fa-times"></i>
  </button>
  
  <!-- Lista del menu -->
  <ul class="list-unstyled text-center">
    
    <!-- Enlaces por defecto -->
    <li><a href="index.php">Inicio</a></li>
    <li><a href="product.php">Productos</a></li>
    <li><a href="carrito.php">Carrito</a></li>
    
    <!-- Enlaces de administrador -->
    <?php 
    if(!$_SESSION['nombreAdmin']==""){
     echo '<li><a href="configAdmin.php">Administración</a></li>';
   }elseif(!$_SESSION['nombreUser']==""){
     echo '<li><a href="pedido.php">Pedido</a></li>';
   }else{
     echo 'Otros campos';
   }
   ?>

 </ul>
</div>