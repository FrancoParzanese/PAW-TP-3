<!DOCTYPE html>
<html>
	<head>
		<title>Solicitar turno</title>
		<meta charset="UTF-8" />
		<style>

			.req {
				color: red;
			}

		</style>
	</head>
	<body>
		<h1>Solicitar turno en el médico</h1>
		<nav>| <a href="list">Lista de turnos</a> | <a href="../add">Nuevo turno</a> |</nav>
		<h2>Ingresar datos:</h2>
		<form method="POST" action="<?= $action ?>"
				enctype="multipart/form-data">
			<label for="nombre">Nombre del paciente*:</label>
			<input type="text" name="nombre" value="<?= $data["nombre"] ?>" />
			<p class="req">*  Requerido</p>
			<label for="email">Email*:</label>
			<input type="email" name="email" value="<?= $data["email"] ?>" />
			<p class="req">*  Requerido</p>
			<label for="telefono">Teléfono*:</label>
			<input type="text" name="telefono" value="<?= $data["telefono"] ?>" />
			<p class="req">*  Requerido</p>
			<label for="calzado">Talla de calzado:</label>
			<input type="number" name="calzado" min="20" max="45" value="<?= empty($data["calzado"]) ? "" : $data["calzado"] ?>" />
			<label for="altura">Altura:</label>
			<input type="range" name="altura" min="50" max="250" value="<?= $data["altura"] ?>" />
			<p>Entre 50 cm. y 250 cm.</p>
			<label for="nacimiento">Fecha de nacimiento*:</label>
			<input type="date" name="nacimiento" min="1900-01-01" max="<?= $nacMax ?>" value="<?= $data["nacimiento"] ?>" />
			<p class="req">*  Requerido</p>
			<label for="pelo">Color de pelo:</label>
			<input type="color" name="pelo" value="<?= $data["pelo"] ?>" />
			<label for="fecha">Fecha del turno*:</label>
			<input type="date" name="fecha" min="<?= $fechaMin ?>" max="<?= $fechaMax ?>" value="<?= $data["fecha"] ?>" />
			<p class="req">*  Requerido</p>
			<label for="horario">Horario del turno*:</label>
			<select name="horario">
			<?php

				for ($h = 8; $h < 17; $h++) {
					for ($cm = 0; $cm < 4; $cm++) {
						$opt = "$h:";
						$opt .= $cm == 0 ? "00" : 15 * $cm;
						echo '<option value="' . $opt . '"';
						echo $opt == $data["horario"] ? " selected" : "";
						echo '>' . $opt . '</option>';
					}
				}
				echo '<option value="17:00"';
				echo $data["horario"] == "17:00" ? " selected" : "";
				echo '>17:00</option>';

			?>
			</select>
			<p class="req">*  Requerido</p>
			<!--<label for="imagen">Adjuntar una imagen:</label>
			<input type="file" name="diagnostico" />-->
			<input type="reset" value="Limpiar" />
			<input type="submit" value="Enviar" />
		</form>
	</body>
</html>