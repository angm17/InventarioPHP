<?php
if (isset($_POST["enviar"])) {
	$id = $_POST["id"];
	$pedido = $_POST["pedido"];
	$cantidad = $pedido;
	$precio = $_POST["precio"];
	$subtotal = $pedido * $precio;
	$iva = $subtotal * ($config->iva/100);
	$total = $subtotal + $iva;
	$tipo = $config->tipo_inventario ? "DESC":"ASC";
	$query = "SELECT * FROM lote WHERE id_producto = '$id' ORDER BY id_lote ".$tipo;
	$resultados = $db->query($query);+
	$i = 0;
	while ($x = $resultados->fetch_object()) {
		if ($x->cantidad>0) {
			
			if (!($pedido <= 0)) {
				if ($x->cantidad <= $pedido ) {
					
					$pedido = $pedido - $x->cantidad;
					$edit = 0;
				}else{
					$pedido = $pedido - $x->cantidad;
					$edit = $pedido*-1;
				}
			$lote[$i] = array("id" => $x->id_lote, "edit"=> $edit); 	
			}else{
				break;
			}
			
		$i++;}
	}
	foreach ($lote as $key => $value) {
			$id_lote = $value["id"];
			$query = $db->prepare("UPDATE lote SET cantidad = ? WHERE id_lote = '$id_lote'");
			$query->bind_param("i", $value["edit"]);
			$query->execute();
	}
	$factura = $db->query("INSERT INTO factura (id_producto, precio, cantidad, iva, subtotal, total) 
		VALUES ('$id','$precio','$cantidad','$iva','$subtotal','$total')");
	$redirect = $db->query("SELECT LAST_INSERT_ID() FROM factura");
	$x=$redirect->fetch_object();
	foreach ($x as $key => $value) {
		$id = $value;
	}
	header("location: index.php?page=inicio&accion=factura&id=".$id);
?>
<center>Se ha realizado la operación satisfactoriamente</center>
<?php
}
$id = isset($_GET["id"]) ? (is_numeric($_GET["id"]) ? $_GET["id"] : header("Location: index.php")): header("Location: index.php"); 
$query = "SELECT * FROM producto
LEFT JOIN lote on lote.id_producto = producto.id_producto
WHERE producto.id_producto = '$id'";
$resultados = $db->query($query);//"SELECT * FROM producto WHERE id_producto = '$id'");
$cantidad = 0;
$i = 0;
while ($x=$resultados->fetch_object()) {
	$nombre = $x->nombre_producto;
	$precio = $x->precio_venta_producto;
	if ($x->cantidad>0) {

		$lote[$i]= $x->cantidad;
		$cantidad = $x->cantidad+$cantidad;
		
		$i++;}

}


?>

<div id="registrar">	
	<form method="POST" action="http://localhost/programacion/index.php?page=articulo&id=<?php echo $id;?>">
	<input type="hidden" name="id" value="<?php echo $id;?>">
		<label class="opcion">Nombre del producto:</label>
		<input type="text" name="nombre" value = "<?php echo $nombre;?>" readonly>
		<label class="opcion">Cantidad en Inventario:</label>
		<input type="text" name="cantidad" value = "<?php echo $cantidad;?>" readonly>
		<label class="opcion">Precio de Venta:</label>
		<input type="text" name="precio" value = "<?php echo $precio;?>" readonly>
		<label class="opcion">Pedido:</label>
		<input type="number" name="pedido" min="1" max="<?php echo $cantidad;?>" required>
		<input type="submit" name="enviar">
		</form>
</div>