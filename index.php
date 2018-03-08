<?php


require "./db/connect.php";
require "./modulos/funciones.php";

$buscador = false;
$sesion = true;
if (isset($_GET["buscar"])) {
	$buscar = $_GET["buscar"];
	$buscador = true;
	}
if(!isset($_SESSION['sesion'])){
    $page = "inicio";
    $accion = "login";
    $sesion = false;
}else{
	$page = (isset($_GET["page"])) ? $_GET["page"] : "inicio";
	$accion = isset($_GET["accion"]) ? $_GET["accion"] : "inventario";
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo ucfirst($page).": ".ucfirst($accion); ?></title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<div id="contenedor">
		<ul>
		  <li><a <?php if($page == "inicio"){ echo 'class="active"';} ?> href="index.php">Inicio</a></li>
		  <li><a <?php if($page == "historial"){ echo 'class="active"';} ?> href="index.php?page=historial">Historial</a></li>
		  <li><a <?php if($page == "config"){ echo 'class="active"';} ?> href="index.php?page=config">Configuración</a></li>
		  <?php echo $sesion ? '<li> <a href="index.php?page=inicio&accion=logout">Cerrar Sesion</a></li>' : '' ?>
		</ul>

		<?php 
		if(!@require_once("./modulos/".$page.".php")) throw new Exception("Error al cargar '".$page.".php'");
		?>
	</div>
</body>
</html>