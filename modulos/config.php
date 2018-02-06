<?php
if (isset($_POST["enviar"])) {
	$metodo = trim($_POST["metodo"]);
	$limite = $_POST["limite"];
	$query = $db->prepare("UPDATE config SET tipo_inventario = ?, limite_busqueda = ? WHERE config = 0");
	$query->bind_param("ii", $metodo, $limite);
	$query->execute();

?>
<center>Se ha actualizado la configuracion.</center>
<?php
}
?>
<div id="registrar">	
	<form method="POST" action="index.php?page=config">
		<label class="opcion">Método de Inventario</label>
		<select name="metodo">
			<option value="0" <?php echo $config->tipo_inventario ? "" : "selected='selected'"; ?>>First in First Out (FIFO)</option>
			<option value="1" <?php echo  $config->tipo_inventario ? "selected='selected'" : ""; ?>>Last In First Out (LIFO)</option>
		</select>
		<label class="opcion">Limite de resultados</label>
		<input type="text" name="limite" value="<?php echo $config->limite_busqueda; ?>">
		<input type="submit" name="enviar" value="Guardar configuracion">
	</form>

</div>