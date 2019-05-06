<?php

namespace PAW\Libs;
use PAW\Modelos\Conexion;

/**
 * Clase base para controladores.
 *
 * @author Santiago Ricci <sricci.soft at gmail.com>.
 */
abstract class Controlador {

	/**
	 * Ruta del archivo de configuración para la conexión a la base de datos.
	 */
	const CONNECTION = '..\\PAW\\config\\Connection.json';

    /**
     * Nombre de la clase a emplear como vista.
     * @var string.
     */
    private $viewClass;

    /**
     * Variables para el renderizado de la vista.
     * @var array.
     */
    private $variablesVista;

    public function __construct() {
        $this->variablesVista = [];
        $this->viewClass = 'PAW\\Libs\\VistaHTMLSimple';
    }

    public function redireccionar($localizacion) {
        header("Location: $localizacion");
        exit();
    }

    public function ejecutarAccion($nombre, $parametros = []) {
        //call_user_method_array($nombre, $this, $parametros);
        call_user_func_array([$this,$nombre], $parametros);
        $claseVista = $this->getViewClass();
        /* @var $vista Vista */
        $vista = new $claseVista();
        foreach ($this->variablesVista as $nombreVar => $valor) {
            $vista->setVariable($nombreVar, $valor);
        }
        $fqcn = explode('\\', get_class($this));
        $controllerName = array_pop($fqcn);
        $vista->dibujar($controllerName. DIRECTORY_SEPARATOR . $nombre);
    }

    public function pasarVariableAVista($nombre,$valor) {
        $this->variablesVista[$nombre] = $valor;
    }

    public function setViewClass($viewClass) {
        $this->viewClass = $viewClass;
    }

    public function getViewClass() {
        return $this->viewClass;
    }

	/**
	 * Conectarse a la base de datos con los datos definidos en el archivo de configuración.
	 * @return Conexion|false El objeto Conexion si todo salió bien, o 'false' en caso de error.
	 */
	public function conectarABaseDeDatos() {
		try {
			$file = fopen(self::CONNECTION, "r");
			$read = fread($file, filesize(self::CONNECTION));
			fclose($file);
			$json = json_decode($read, true);
			$conn = new Conexion($json["host"], $json["dbname"], $json["user"], $json["pass"]);
			return $conn;
		} catch (Exception $e) {
			return false;
		}
	}

}

?>
