<?php
$factura = false;
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$factura= true;
	$facturas = $db->query("SELECT * FROM factura WHERE id = '$id'");
	if ($facturas->num_rows == 1) {
		$row = $facturas->fetch_object();
	}
	$producto = $db->query("SELECT nombre_producto FROM producto where id_producto = '$row->id_producto'");
	if ($producto->num_rows == 1) {
		$producto = $producto->fetch_object();
	}

}else {
	
	$facturas = $db->query("SELECT * FROM factura");

	}





?>

<div id="inicio">
	<table>
		<?php
			if (!$factura) {
		?>
	<thead >
		<tr>
			<td>ID Factura</td>
			<td>Fecha</td>
			<td>Monto</td>
		</tr>
	</thead>

	<tbody>
		<?php
				if($facturas->num_rows){
					while ($row = $facturas->fetch_object()) {

						?>

							<tr>
								<td><?php echo $row->id;?></td>
								<td><a href="index.php?page=inicio&accion=factura&id=<?php echo $row->id;?>"><?php echo $row->fecha;?></a></td>
								<td><?php echo $row->total;?></td>
							</tr>

						<?php


					}
					}
					?>
			
	</tbody>
		<?php
	}else{
		?>
		<div class ="tabla">
		<thead style="text-align: left;">
			<tr>
				<td colspan="6">Factura Nº: <?php echo $row->id; ?></td>
			</tr>
			<tr>
			<td colspan="6">Fecha: <?php echo $row->fecha; ?></td>
			</tr>
		</thead>
		<thead>
			<tr>
				<td>ID Producto</td>
				<td>Descripción</td>
				<td>Cantidad</td>
				<td>Precio Unidad</td>
			</tr>

		</thead>

		<tbody>
			<tr>
				<td><?php echo $row->id_producto; ?></td>
				<td><?php echo $producto->nombre_producto; ?></td>
				<td><?php echo $row->cantidad; ?></td>
				<td><?php echo $row->precio; ?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
			<td colspan="6">Subtotal: <?php echo $row->subtotal; ?></td>
			</tr>
			<tr>
			<td colspan="6">IVA (12%): <?php echo $row->iva; ?></td>
			</tr>
			<tr>
			<td colspan="6">Total: <?php echo $row->total; ?></td>
			</tr>
		</tfoot>
		</div>
		<?php


	}
		?>
	</table>

</div>