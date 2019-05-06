<!DOCTYPE html>
<html>
	<head>
		<title>Turnos</title>
		<meta charset="UTF-8" />
	</head>
	<body>
		<h1>Lista de turnos</h1>
		<nav>| Lista de turnos | <a href="add">Nuevo turno</a> |</nav>
		<table>
			<thead>
				<tr>
					<th>Fecha del turno</th>
					<th>Hora del turno</th>
					<th>Nombre del paciente</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Ficha</th>
					<th>Enlaces</th>
				</tr>
			</thead>
			<tbody>
				<?php

					if (count($data) == 0) {
						echo '<td colspan="6" style="text-align:center">No se han registrado turnos aún.</td>';
					} else {
						for ($i = 0; $i < count($data); $i++) {
							echo "<tr><td>" . $data[$i]["fecha"] . "</td>";
							echo "<td>" . $data[$i]["horario"] . "</td>";
							echo "<td>" . $data[$i]["nombre"] . "</td>";
							echo "<td>" . $data[$i]["telefono"] . "</td>";
							echo "<td>" . $data[$i]["email"] . "</td>";
							echo '<td><a href="view/' . $data[$i]["id"] . '">Ver ficha</a></td>';
							echo '<td><a href="edit/' . $data[$i]["id"] . '">Editar</a> ';
							echo '<a href="delete/' . $data[$i]["id"] . '">Borrar</a></td>';
						}
					}

				?>
			</tbody>
		</table>
	</body>
</html>