<!DOCTYPE html>
<html>
	<head>
		<title>Resumen del turno</title>
		<meta charset="UTF-8" />
	</head>
	<body>
		<h1>Ficha del turno:</h1>
		<?php

			if (!empty($data["diagnostico"])) {
				echo '<img src="' . $data["diagnostico"] . '" alt="Diagnóstico" width="100px" height="100px" />';
			}

		?>
		<table>
			<thead>
				<tr>
					<th colspan="2">Resumen del turno</th>
				</tr>
			</thead>
			<tbody>
				<?php

					foreach ($data as $k => $v) {
						if ($k != "diagnostico") {
							echo "<tr><th>$k</th><td>$v</td></tr>";
						}
					}

				?>
			</tbody>
		</table>
		<a href="../edit/<?= $data["id"] ?>">Editar</a><br />
		<a href="../delete/<?= $data["id"] ?>">Borrar</a><br />
		<a href="../list">Volver a la lista de turnos</a>
	</body>
</html>