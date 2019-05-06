<?php

$nombre = $email = $telefono = $calzado = $altura = $nacimiento = $pelo = $fecha = $horario = $diagnostico = "";
$ultimoMensaje = "";

/* Función que elimina caracteres extras, y convierte a códigos HTML. */
function validar($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

/* Función que determina la edad. */
function edad($nacimiento) {
	$fecha = strtotime($nacimiento);
	$res = date("Y") - date("Y", $fecha);
	if (date("m") < date("m", $fecha)) {
		return $res - 1;
	} else if (date("m") == date("m", $fecha) && date("d") < date("d", $fecha)) {
		return $res - 1;
	}
	return $res;
}

/* Función que devuelve el nombre para guardar un archivo asociado al turno. */
function getImageName($fecha, $hora) {
	$aux = strtotime($fecha);
	$res = date("Y-m-d", $aux);
	$aux = strtotime($hora);
	$res .= "-".date("H-i", $aux);
	return $res;
}

/* Función que devuelve la extensión de un archivo cargado. */
function getExtension($archivo) {
	$res = basename($archivo["name"]);
	$res = explode(".", $res);
	$res = $res[count($res) - 1];
	return $res;
}

/* Validaciones: */
/* Valor booleano que indica si el formulario se completó correctamente. Inicialmente 'true'. */
$esValido = true;
$imagenValida = true;
/* Validar nombre del paciente. */
$data = null;
if (isset($_REQUEST["nombre"])) {
	$data = validar($_REQUEST["nombre"]);
	$data = filter_var($data, FILTER_SANITIZE_STRING);
	if (strlen($data) > 0) {
		$nombre = $data;
	} else {
		$esValido = false;
		$ultimoMensaje = "El nombre es obligatorio.";
	}
} else {
	$esValido = false;
	$ultimoMensaje = "El nombre es obligatorio.";
}
/* Validar email. */
if (isset($_REQUEST["email"])) {
	$data = validar($_REQUEST["email"]);
	$data = filter_var($data, FILTER_SANITIZE_EMAIL);
	if (filter_var($data, FILTER_VALIDATE_EMAIL) == true) {
		$email = $data;
	} else {
		$esValido = false;
		$ultimoMensaje = "El email es inválido.";
	}
} else {
	$esValido = false;
	$ultimoMensaje = "El email es inválido.";
}
/* Validar teléfono. */
if (isset($_REQUEST["telefono"])) {
	$data = validar($_REQUEST["telefono"]);
	if (strlen($data) > 0) {
		$telefono = $data;
	} else {
		$esValido = false;
		$ultimoMensaje = "El teléfono es inválido.";
	}
} else {
	$esValido = false;
	$ultimoMensaje = "El teléfono es inválido.";
}
/* Validar talla de calzado. */
if (isset($_REQUEST["nombre"])) {
	if (strlen($_REQUEST["calzado"]) > 0) {
		$data = validar($_REQUEST["calzado"]);
		if (filter_var($data, FILTER_VALIDATE_INT, array("options" => array("min_range" => 20, "max_range" => 45))) == true) {
			$calzado = $data;
		} else {
			$esValido = false;
			$ultimoMensaje = "La talla de calzado es inválida o no está dentro del rango válido (20..45).";
		}
	} else {
		$calzado = "";
	}
} else {
	$calzado = "";
}
if (isset($_REQUEST["altura"])) {
	$altura = $_REQUEST["altura"];
} else {
	$altura = "";
}
if (isset($_REQUEST["nacimiento"])) {
	if (strlen($_REQUEST["nacimiento"]) > 0) {
		$nacimiento = $_REQUEST["nacimiento"];
	} else {
		$esValido = false;
	}
} else {
	$esValido = false;
}
if (isset($_REQUEST["pelo"])) {
	$pelo = $_REQUEST["pelo"];
} else {
	$pelo = "";
}
if (isset($_REQUEST["fecha"])) {
	if (strlen($_REQUEST["fecha"]) > 0) {
		$fecha = $_REQUEST["fecha"];
	} else {
		$esValido = false;
		$ultimoMensaje = "La fecha del turno es obligatoria.";
	}
} else {
	$esValido = false;
	$ultimoMensaje = "La fecha del turno es obligatoria.";
}
if (isset($_REQUEST["horario"])) {
	$horario = $_REQUEST["horario"];
} else {
	$esValido = false;
	$ultimoMensaje = "El horario del turno es obligatorio.";
}
if ($esValido) {
	$edad = edad($nacimiento);
	if (!empty($_FILES["diagnostico"])) {
		$tipoImagen = strtolower(getExtension($_FILES["diagnostico"]));
		$destinoImagen = "../PAW/imagenesCargadas/" . getImageName($fecha, $horario) . ".$tipoImagen";
		if (isset($_POST["submit"])) {
			$check = getimagesize($_FILES["diagnostico"]["tmp_name"]);
			if ($check === false) {
				$ultimoMensaje = "El archivo cargado no es una imagen.";
				$imagenValida = false;
			}
		}
		if ($_FILES["diagnostico"]["size"] > 10000000) {
			$ultimoMensaje = "El archivo supera el límite de 10 MB.";
			$imagenValida = false;
		}
		if ($tipoImagen != "jpg" && $tipoImagen != "png") {
			$ultimoMensaje = "Los tipos de imagen permitidos son JPG y PNG.";
			$imagenValida = false;
		}
		if ($imagenValida) {
			if (move_uploaded_file($_FILES["diagnostico"]["tmp_name"], $destinoImagen)) {
				$diagnostico = "../../../imagenesCargadas/" . getImageName($fecha, $horario) . ".$tipoImagen";
			} else {
				$ultimoMensaje = "No se pudo cargar la imagen.";
				$imagenValida = false;
			}
		}
	}
}

?>
