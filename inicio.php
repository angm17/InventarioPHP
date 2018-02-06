<div id="opciones">
		<ul>
			<li><a <?php if($accion == "facturar"){ echo 'class="active"';} ?> href="index.php?page=inicio&accion=facturar">Facturar</a></li>
			<li><a <?php if($accion == "registrar"){ echo 'class="active"';} ?> href="index.php?page=inicio&accion=registrar">Registrar Producto</a></li>
			<li><a <?php if($accion == "agregar"){ echo 'class="active"';} ?> href="index.php?page=inicio&accion=agregar">Agregar Lote</a></li>
		</ul>

</div>
<?php
if($accion == ""){
?>
<div id="inicio">
	<table>
		<thead>
			<tr>
				<td>Id</td>
				<td colspan="4">Producto</td>
				<td>Cantidad en Inventario</td>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>

<?php
}elseif ($accion == "facturar") {
?>
<a href="index.php">Cancelar</a>

<?php	
}elseif ($accion == "registrar") {
?>
<a href="index.php">Cancelar registro</a>

<?php	
}elseif ($accion == "agregar") {
?>
<a href="index.php">Cancelar agregar</a>

<?php	
}
?>