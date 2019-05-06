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
		<nav>| <a href="list">Lista de turnos</a> | Nuevo turno |</nav>
		<h2>Ingresar datos:</h2>
		<form method="POST" action="<?= $action ?>"
				enctype="multipart/form-data">
			<label for="nombre">Nombre del paciente*:</label>
			<input type="text" name="nombre" />
			<p class="req">*  Requerido</p>
			<label for="email">Email*:</label>
			<input type="email" name="email" />
			<p class="req">*  Requerido</p>
			<label for="telefono">Teléfono*:</label>
			<input type="text" name="telefono" />
			<p class="req">*  Requerido</p>
			<label for="calzado">Talla de calzado:</label>
			<input type="number" name="calzado" min="20" max="45" />
			<label for="altura">Altura:</label>
			<input type="range" name="altura" min="50" max="250" />
			<p>Entre 50 cm. y 250 cm.</p>
			<label for="nacimiento">Fecha de nacimiento*:</label>
			<input type="date" name="nacimiento" min="1900-01-01" max="<?= $nacMax ?>" />
			<p class="req">*  Requerido</p>
			<label for="pelo">Color de pelo:</label>
			<input type="color" name="pelo" />
			<label for="fecha">Fecha del turno*:</label>
			<input type="date" name="fecha" min="<?= $fechaMin ?>" max="<?= $fechaMax ?>" />
			<p class="req">*  Requerido</p>
			<label for="horario">Horario del turno*:</label>
			<select name="horario">
			<?php

				for ($h = 8; $h < 17; $h++) {
					echo '<option value="'.$h.':00">'.$h.':00</option>';
					echo '<option value="'.$h.':15">'.$h.':15</option>';
					echo '<option value="'.$h.':30">'.$h.':30</option>';
					echo '<option value="'.$h.':45">'.$h.':45</option>';
				}
				echo '<option value="17:00">17:00</option>';

			?>
			</select>
			<p class="req">*  Requerido</p>
			<label for="imagen">Adjuntar una imagen:</label>
			<input type="file" name="diagnostico" />
			<input type="reset" value="Limpiar" />
			<input type="submit" value="Enviar" />
		</form>
	</body>
</html>