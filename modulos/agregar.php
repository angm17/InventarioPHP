<?php

$resultados = $db->query("SELECT * FROM producto");

if (isset($_POST["enviar"])) {
	$id = trim($_POST["producto"]);
	$inventario = $_POST["inventario_inicial"];
	$pvc = trim($_POST["precio_compra"]);

	$query = $db->prepare("INSERT INTO lote (id_producto,cantidad,precio_compra) VALUES (?,?,?)");
	$query->bind_param("iii", $id, $inventario,$pvc);
	$query->execute();
	
?>
<center>Se ha agregado el lote satisfactoriamente.</center>
<?php
}else{


?>

<div id="registrar">	
	<form method="POST" action="index.php?page=inicio&accion=agregar">
		<label class="opcion">Nombre del producto</label>
		<select class ="opcion" name = "producto" required>
		<option value="" disabled selected>Selecciona el Producto</option>
		<?php
		if($resultados->num_rows){
			while ($row = $resultados->fetch_object()) {

				?>
				<option value="<?php echo $row->id_producto; ?>"><?php echo $row->nombre_producto;?></option>
				<?php

			}
		$resultados->free();
		}

		?>
		</select>			
		<label class ="opcion">Cantidad</label>
  		<input type="text" name="inventario_inicial" required>
  		<label class="opcion">Precio de compra</label><input type="text" name="precio_compra" required>	
		<input type="submit" value="Agregar Lote" name="enviar">
	</form>
</div>
<?php

}
?>


<a href="index.php">Cancelar</a>

<?php
/*
for ($i=0; $i < 40; $i++) { 
	if ($db->query("INSERT INTO producto (nombre_producto,precio_venta_producto) VALUES ('pantalones',50000)")) {
		# code...
	}
}
*/
?>