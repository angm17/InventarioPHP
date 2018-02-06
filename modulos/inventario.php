<?php
$resultados = $db->query("SELECT limite_busqueda FROM config");
$numpage = ($_GET["numpage"]) ? ((is_numeric($_GET["numpage"])) ? $_GET["numpage"]-1 : 0) : 0 ;
$limitepage = $resultados->fetch_object();
$limitepage = $limitepage->limite_busqueda;
if ($buscador) {
// Es poco efectivo pero es mi solucion temporal. Recordar modificar despues de investigar mas.

	$resultados = $db->query("SELECT * FROM producto WHERE nombre_producto LIKE '%$buscar%' LIMIT ".$limitepage." OFFSET ".($limitepage*$numpage));
	$counter = $db->query("SELECT * FROM producto WHERE nombre_producto LIKE '%$buscar%'");
	$count = $counter->num_rows;
	$counter->free();

}else{
	$resultados = $db->query("SELECT * FROM producto LIMIT ".$limitepage." OFFSET ".($limitepage*$numpage));
	$counter = $db->query("SELECT * FROM producto");
	$count = $counter->num_rows;
	$counter->free();
}

$count = $count / $limitepage;
$count = (truncate($count)<$count) ? truncate($count)+1 : truncate($count);


/*
$query = "
SELECT producto.id_producto,producto.nombre_producto, producto.precio_venta_producto, lote.id_lote, lote.cantidad,
FROM producto
LEFT JOIN lote on producto.id_producto = lote.id_producto
";
if ($resultados = $db->query($query)) {
	echo "dsd";
}
while ($row = $resultados->fetch_object()) {
echo "kk";
echo $row;
}*/
?>

<div id="inicio">
	
	<table>
		<thead>
			<tr>
				<td>Id</td>
				<td>Descripción del Producto</td>
				<td>Precio de Venta</td>
				<td>Cantidad en Inventario</td>
				<td>Lotes</td>
				<td>Acción</td>
			</tr>
		</thead>
		<tbody>
			<?php
				if($resultados->num_rows){
					
					while ($row = $resultados->fetch_object()) {
						$cantidad = 0;
						$countlote = 0;
						$lote = $db->query("SELECT * FROM lote where id_producto = '$row->id_producto'");
						if ($lote->num_rows) {
							while ($rowlote = $lote->fetch_object()) {
								if ($rowlote->cantidad>0) {
									$countlote++;
									$cantidad = $rowlote->cantidad+$cantidad;
								}
							}
						}
						if (!($cantidad <=0)) {
						
						?>
							<tr>
								<td><?php echo $row->id_producto;?></td>
								<td><?php echo $row->nombre_producto;?></td>
								<td><?php echo $row->precio_venta_producto;?></td>
								<td><?php echo $cantidad;?></td>
								<td><?php echo $countlote;?></td>
								<td><a href="index.php?page=articulo&id=<?php echo $row->id_producto;?>">Pedido</a></td>

							</tr>
						<?php
					}}
					$resultados->free();
				}else{
			?>
			<tr>
				<td colspan="6"><center>No se encontraron resultados.</center></td>
			</tr>
			<?php
				}
			?>
				
		</tbody>
	</table>

	<?php
	if ($count>1) {
		# code...
	
	?>
	<div id="paginador">
		<ul>
			<?php
				for ($i=1; $i <= $count; $i++) { 
					$b = $buscador ? "&buscar=".$buscar : "";
					echo "<li><a href='?numpage=".$i.$b."'>".$i."</a></li>";

					//echo "<li><a href='?numpage=".$i+1."'>".$i+1."</a></li>";
				}
			?>
		</ul>
	</div>
	<?php
	}
	?>
</div>