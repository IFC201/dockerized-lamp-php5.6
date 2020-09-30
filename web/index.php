<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Inicio</title>
		<?php include './inc/link.php'; ?>
	</head>

	<body id="container-page-index">
		<?php include './inc/navbar.php'; ?>
		
		<div class="jumbotron" id="jumbotron-index">
			<h1><span class="tittles-pages-logo">FLORART</span></h1>
		</div>

		<section id="new-prod-index" class="contenedor-flex">
			<div class="container">
				<div class="page-header">
					<h1>Últimos 3 <small>productos agregados</small></h1>
				</div>
				<div class="row">
					<?php // Si hay productos registrados
					  include 'library/configServer.php';
					  include 'library/consulSQL.php';
					  $consulta= ejecutarSQL::consultar("SELECT * FROM producto WHERE Stock > 0 AND Estado='Activo' ORDER BY id DESC LIMIT 3");
					  $totalproductos = mysqli_num_rows($consulta);
					  if($totalproductos>0){
						  while($fila=mysqli_fetch_array($consulta, MYSQLI_ASSOC)){
					?>
					<!-- Grid  -->
					<div class="col-xs-12 col-sm-6 col-md-4">
						 <div class="thumbnail">
						   <img src="assets/img-products/<?php if($fila['Imagen']!="" && is_file("./assets/img-products/".$fila['Imagen'])){ echo $fila['Imagen']; }else{ echo "default.png"; } ?>">
						   <div class="caption">
						   		<h3><?php echo $fila['NombreProd']; ?></h3>
								<p><?php echo 'Categoría: '.$fila['Marca']; ?></p>
								<p><?php echo 'Precio: '.$fila['Precio'].' €'; ?></p>
							<p class="text-center">
								<a href="infoProd.php?CodigoProd=<?php echo $fila['CodigoProd']; ?>" class="btn btn-primary btn-sm btn-raised btn-block"><i class="fa fa-plus"></i>&nbsp; Detalles</a>
							</p>
						   </div>
						 </div>
					</div>     
					<?php
						 }   
					  }else{ // Si no hay productos registrados
						  echo '<h2>No hay productos registrados en la tienda</h2>';
					  }  
					?>  
				</div>
			</div>
		</section>
		
		<section id="reg-info-index" class="contenedor-flex">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 text-center">

					</div>

				</div>
			</div>
		</section>
		<?php include './inc/footer.php'; ?>
		<!--<script src="http://127.0.0.1:35729/livereload.js?ext=Chrome&amp;extver=2.1.0"></script>-->
	</body>
</html>