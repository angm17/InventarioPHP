<?php

if (isset($_POST["enviar"])) {
	$nombre = trim($_POST["nombre_producto"]);
	$pvp = trim($_POST["precio_venta"]);
	$inventario = $_POST["inventario_inicial"];
	$inventario = (is_numeric($inventario)) ? (($inventario>0) ? $inventario:0) : 0;
	$pvc = trim($_POST["precio_compra"]);

	$query = $db->prepare("INSERT INTO producto (nombre_producto,precio_venta_producto) VALUES (?,?)");
	$query->bind_param("si",$nombre, $pvp);
	$query->execute();
	if ($inventario>0) {
		$id = $db->insert_id;
		$query = $db->prepare("INSERT INTO lote (id_producto,cantidad,precio_compra) VALUES (?,?,?)");
		$query->bind_param("iii", $id, $inventario,$pvc);
		$query->execute();
	}

?>
<center>Se ha agregado el producto satisfactoriamente.</center>
<?php

}else{
	# code...
?>

<div id="registrar">	
	<form method="POST" action="index.php?page=inicio&accion=registrar">
		<label class="opcion">Nombre del producto</label><input type="text" name="nombre_producto" required>
		<label class="opcion">Precio de Venta</label><input type="text" name="precio_venta" required>
		<label class ="opcion opinvi" for="inventario">Inventario Inicial</label> <input class ="opinvi" type="checkbox" name="inventario" id="inventario">
		<div class="reveal-if-active">
  		<input type="text" name="inventario_inicial">
  		<label class="opcion">Precio de compra</label><input type="text" name="precio_compra">
		</div>

		
		<input type="submit" value="Agregar Producto" name="enviar">
	</form>
</div>
<?php
} ?>

<a href="index.php">Cancelar</a>