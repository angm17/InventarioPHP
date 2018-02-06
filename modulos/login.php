<?php
$error = false;
if (isset($_POST["enviar"])) {
	$usuario = $_POST["user"];
	$password = $_POST["password"];
	$login = $db->query("SELECT * FROM usuario WHERE usuario = '$usuario' and password = '$password'");
	if ($login->num_rows == 1) {
		$_SESSION['sesion'] = $usuario;
		header("location: index.php");
	}else{
		$error = true;
	}
}


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="inicio">
	<form action="index.php" method="POST">
		<table>
			<?php
				if ($error) {
					?>
					<tr>
						<td colspan="2"><center>¡Usuario o Contraseña incorrecta!</center></td>
					</tr>
					<?php
				}
			?>
			<tr>
				<td>Nombre de Usuario</td>
				<td><input type="text" name="user"></td>
			</tr>
			<tr>
				<td>Contraseña</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td colspan="2"><center><input type="submit" name="enviar" value="Iniciar Sesion"></center></td>
			</tr>
		</table>
	</form>
	</div>
</body>
</html>