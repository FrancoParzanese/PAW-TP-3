<?php

namespace PAW\Controladores;
use PAW\Libs\VIstaHTML;
use PAW\Modelos\Validacion;
use PAW\Modelos\Turno;
use PDO;

/**
 * Controlador de turnos.
 *
 * @author Franco L. Parzanese.
 */
class Turnos extends \PAW\Libs\Controlador {

	public function add() {
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$fechaMin = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 1, date("Y")));
		$fechaMax = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 21, date("Y")));
		$this->pasarVariableAVista("nacMax", date("Y-m-d"));
		$this->pasarVariableAVista("fechaMin", $fechaMin);
		$this->pasarVariableAVista("fechaMax", $fechaMax);
		$this->pasarVariableAVista("action", "validaradd");
	}

	public function delete($id) {
		try {
			$conn = $this->conectarABaseDeDatos();
			if ($conn === false) {
				die("Error 500");
			}
			$stmt = $conn->prepararConsulta("DELETE FROM turnos WHERE id = :id");
			if ($stmt === false) {
				die("Error 500");
			}
			$stmt->bindParam(":id", $id);
			if (!$stmt->execute()) {
				die("Error 500");
			}
			header("Location: /PAW/index.php/turnos/list");
			exit;
		} catch (Exception $e) {
			die("Error 500");
		}
	}

	public function edit($id) {
		try {
			$conn = $this->conectarABaseDeDatos();
			if ($conn === false) {
				die("Error 500");
			}
			$stmt = $conn->prepararConsulta("SELECT * FROM turnos WHERE id = :id");
			if ($stmt === false) {
				die("Error 500");
			}
			$stmt->bindParam(":id", $id);
			if (!$stmt->execute()) {
				die("Error 500");
			}
			$res = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($res) {
				unset($res["diagnostico"]);
				$this->pasarVariableAVista("data", $res);
				$fechaMin = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 1, date("Y")));
				$fechaMax = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 21, date("Y")));
				$this->pasarVariableAVista("nacMax", date("Y-m-d"));
				$this->pasarVariableAVista("fechaMin", $fechaMin);
				$this->pasarVariableAVista("fechaMax", $fechaMax);
				$this->pasarVariableAVista("action", "../validaredit/$id");
			} else {
				header("Location: /PAW/index.php/turnos/list");
				exit;
			}
		} catch (Exception $e) {
			die("Error 500");
		}
	}

	public function error($error) {
		$this->pasarVariableAVista("error", $error);
	}

	public function list() {
		try {
			$conn = $this->conectarABaseDeDatos();
			if ($conn === false) {
				die("Error 500");
			}
			$stmt = $conn->prepararConsulta("SELECT id, fecha, horario, nombre, telefono, email FROM turnos");
			if ($stmt === false) {
				die("Error 500");
			}
			if (!$stmt->execute()) {
				die("Error 500");
			}
			$conn->cerrar();
			$this->pasarVariableAVista("data", $stmt->fetchAll());
		} catch (Exception $e) {
			die("Error 500");
		}
	}

	public function validaradd() {
		require "modelos/validacion.php";
		if ($esValido && $imagenValida) {
			$turno = new Turno($nombre, $email, $telefono, $calzado, $altura, $nacimiento, $pelo, $fecha, $horario, $diagnostico);
			$conn = $this->conectarABaseDeDatos();
			if ($conn === false) {
				die("Error 500");
			}
			if ($turno->guardar($conn)) {
				$id = $conn->ultimoId();
				$conn->cerrar();
				header("Location: http://" . $_SERVER["HTTP_HOST"] . "/PAW/index.php/turnos/view/$id");
				exit;
			} else {
				die("Error 500");
			}
		} else {
			header("Location: http://" . $_SERVER["HTTP_HOST"] . "/PAW/index.php/turnos/error/$ultimoMensaje");
			exit;
		}
	}

	public function validaredit($id) {
		require "modelos/validacion.php";
		if ($esValido && $imagenValida) {
			$turno = new Turno($nombre, $email, $telefono, $calzado, $altura, $nacimiento, $pelo, $fecha, $horario, $diagnostico);
			$turno->setId($id);
			$conn = $this->conectarABaseDeDatos();
			if ($conn === false) {
				die("Error 500");
			}
			if ($turno->guardar($conn)) {
				$conn->cerrar();
				header("Location: http://" . $_SERVER["HTTP_HOST"] . "/PAW/index.php/turnos/view/$id");
				exit;
			} else {
				die("Error 500");
			}
		} else {
			header("Location: http://" . $_SERVER["HTTP_HOST"] . "/PAW/index.php/turnos/error/$ultimoMensaje");
			exit;
		}
	}

	public function view($id) {
		try {
			$conn = $this->conectarABaseDeDatos();
			if ($conn === false) {
				die("Error 500");
			}
			$stmt = $conn->prepararConsulta("SELECT * FROM turnos WHERE id = :id");
			if ($stmt === false) {
				die("Error 500");
			}
			$stmt->bindParam(":id", $id);
			if (!$stmt->execute()) {
				die("Error 500");
			}
			$res = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($res) {
				$this->pasarVariableAVista("data", $res);
			} else {
				header("Location: /PAW/index.php/turnos/list");
				exit;
			}
		} catch (Exception $e) {
			die("Error 500");
		}
	}

}

?>
