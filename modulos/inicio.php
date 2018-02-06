<div id="opciones">
		<ul>
			<li><a <?php if($accion == "facturar"){ echo 'class="active"';} ?> href="index.php?page=inicio&accion=factura">Facturas</a></li>
			<li><a <?php if($accion == "registrar"){ echo 'class="active"';} ?> href="index.php?page=inicio&accion=registrar">Registrar Producto</a></li>
			<li><a <?php if($accion == "agregar"){ echo 'class="active"';} ?> href="index.php?page=inicio&accion=agregar">Agregar Lote</a></li>
			<li>
				<form method="get" action = "index.php">
					<input type="text" placeholder="Buscar" name="buscar" <?php if($buscador){ echo "value='".$buscar."'";} ?> required>
				</form>	
			</li>
		</ul>


</div>
<?php

if(!@require_once($accion.".php")) throw new Exception("Error al cargar '".$accion.".php'");

/*if (file_exists($accion.".php")) {
    require $accion.".php";	
} 
/*
if ($accion == "facturar" or $accion == "registrar" or $accion == "agregar" or $accion == "inventario") {
require $accion.".php";
}*/
?>