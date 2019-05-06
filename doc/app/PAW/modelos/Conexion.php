<?php

namespace PAW\Modelos;
use PDO;

/**
 * Clase para la gestión de la conexión a la base de datos.
 *
 * @author Franco L. Parzanese.
 */
class Conexion {
	/**
	 * La conexión en sí.
	 * @var Object.
	 */
	private $conn;
	/**
	 * Construir un objeto Conexion.
	 * @param String Host al cual se establecerá la conexión.
	 * @param String Nombre de la base de datos.
	 * @param String Nombre de usuario en el SGBD.
	 * @param String Contraseña del usuario en el SGBD.
	 */
	public function __construct($host, $dbname, $user, $pass) {
		try {
			$this->conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			$sql = $this->conn->prepare("CREATE TABLE IF NOT EXISTS `Turnos` (
					`id` INT NOT NULL AUTO_INCREMENT ,
					`nombre` VARCHAR(45) NOT NULL , `email` VARCHAR(45) NOT NULL ,
					`telefono` VARCHAR(20) NOT NULL , `calzado` INT NULL DEFAULT NULL ,
					`altura` INT NULL DEFAULT NULL , `nacimiento` VARCHAR(10) NOT NULL ,
					`pelo` VARCHAR(10) NULL DEFAULT NULL , `fecha` VARCHAR(10) NOT NULL ,
					`horario` VARCHAR(5) NOT NULL , `diagnostico` VARCHAR(255) NULL DEFAULT NULL ,
					PRIMARY KEY (`id`)) ENGINE = InnoDB;");
			$sql->execute();
		} catch (PDOException $e) {
			$this->conn = null;
		}
	}
	/**
	 * Cerrar una conexión.
	 */
	public function cerrar() {
		$this->conn = null;
	}
	/**
	 * Crear una 'prepared statement'.
	 * @param String Consulta a preparar.
	 * @return PDOStatement|false El objeto PDOStatement si todo salió bien, o 'false' en caso de error.
	 */
	public function prepararConsulta($sql) {
		try {
			return $this->conn->prepare($sql);
		} catch (PDOException $e) {
			return false;
		}
	}
	/**
	 * Obtener el ID de la fila insertada. Se debe llamar a esta función luego de haber insertado la fila.
	 * @return Integer ID de la última fila insertada.
	 */
	public function ultimoId() {
		return $this->conn->lastInsertId();
	}

}

?>
