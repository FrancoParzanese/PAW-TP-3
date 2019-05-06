<?php

echo "Se realizará una conexión de prueba a la base de datos Test en localhost, sin usuario ni contraseña.<br />";

try {
	$conn = new PDO("mysql:host=localhost;dbname=Test", "", "");
	$conn = null;
	echo "Conexión de prueba exitosa!";
} catch (PDOException $e) {
	echo "La conexión de prueba falló. Mensaje:<br />{$e->getMessage()}";
} finally {
	phpinfo(INFO_MODULES);
}

?>
