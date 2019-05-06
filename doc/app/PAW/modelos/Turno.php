<?php

namespace PAW\Modelos;
use PAW\Modelos\Conexion;

class Turno {

	private $id;
	private $nombre;
	private $email;
	private $telefono;
	private $calzado;
	private $altura;
	private $nacimiento;
	private $pelo;
	private $fecha;
	private $horario;
	private $diagnostico;

	public function __construct($nombre, $email, $telefono, $calzado, $altura, $nacimiento, $pelo, $fecha, $horario, $diagnostico) {
		$this->id = null;
		$this->nombre = $nombre;
		$this->email = $email;
		$this->telefono = $telefono;
		$this->calzado = $calzado;
		$this->altura = $altura;
		$this->nacimiento = $nacimiento;
		$this->pelo = $pelo;
		$this->fecha = $fecha;
		$this->horario = $horario;
		$this->diagnostico = $diagnostico;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function guardar($conn) {
		if ($this->id === null) {
			$sql = "INSERT INTO turnos (nombre, email, telefono, calzado, altura,
					nacimiento, pelo, fecha, horario, diagnostico) VALUES (:nombre,
					:email, :telefono, :calzado, :altura, :nacimiento, :pelo,
					:fecha, :horario, :diagnostico)";
		} else {
			$sql = "UPDATE turnos SET nombre = :nombre, email = :email,
					telefono = :telefono, calzado = :calzado, altura = :altura,
					nacimiento = :nacimiento, pelo = :pelo, fecha = :fecha,
					horario = :horario WHERE id = :id";
		}
		$stmt = $conn->prepararConsulta($sql);
		if ($stmt === false) {
			die("Error 500");
		}
		if ($this->id === null) {
			$stmt->bindParam(":diagnostico", $this->diagnostico);
		} else {
			$stmt->bindParam(":id", $this->id);
		}
		$stmt->bindParam(":nombre", $this->nombre);
		$stmt->bindParam(":email", $this->email);
		$stmt->bindParam(":telefono", $this->telefono);
		$stmt->bindParam(":calzado", $this->calzado);
		$stmt->bindParam(":altura", $this->altura);
		$stmt->bindParam(":nacimiento", $this->nacimiento);
		$stmt->bindParam(":pelo", $this->pelo);
		$stmt->bindParam(":fecha", $this->fecha);
		$stmt->bindParam(":horario", $this->horario);
		if (!$stmt->execute()) {
			die("Error 500");
		}
		return true;
	}

}

?>
